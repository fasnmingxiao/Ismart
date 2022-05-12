<?php
class ajax extends controller
{
    public $product;
    public $blog;
    function __construct()
    {
        $this->product = $this->model("productM");
        $this->blog=$this->model("blogM");
    }
    function load_product_by_category()
    {
        $limit = 20;
        $page = 1;
        $brand_filter = '';
        $query = '';
        if(isset($_POST['page'])){
            $page=$_POST['page'];
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
            $query = " AND (`tbl_products`.price BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "' )";
        }
        if (isset($_POST["brand"])) {
            $brand_filter = implode("','", $_POST["brand"]);
            $query .= " AND `tbl_products`.category IN('" . $brand_filter . "')";
        }
        if(isset($_POST['sort'])){
            if($_POST['sort'] == 1){
                $query .= "ORDER BY `tbl_products`.product_title  ASC";
            }else if($_POST['sort']==2){
                $query .= "ORDER BY `tbl_products`.product_title  DESC";
            }else if($_POST['sort']==3){
                $query .= "ORDER BY `tbl_products`.price  DESC";
            }else if($_POST['sort']==4){
                $query .= "ORDER BY `tbl_products`.price  ASC"; 
            }
        }
        $total_data = count(json_decode($this->product->show_product_by_cat_id($id, $query), true));

        $result = json_decode($this->product->show_product_by_cat_id($id, $query), true);
        $output = ' <ul class="list-item clearfix">';
        if ($total_data > 0) {
            foreach ($result as $product) {
                $output .= '
                    <li class="wp-product-item">
                    <div>
                    <a href=' . site_url('/product/detail_product/' . $product["id"]) . ' title="" class="thumb">
                    <img src=' . site_url('/public/images/' . $product["product_thumb"]) . '>
                    </a>
                    <a class="product-name" href=' . site_url('/product/detail_product/' . $product["id"]) . '>' . $product["product_title"] . '</a>
                    </div>
                    <div>
                    <div class="price">
                        <span class="new">' . current_format(price_discount($product["price"], $product["discount"]), "Đ") . '</span>
                        <span class="old">' . current_format($product["price"], "Đ") . '</span>
                    </div>
                    <div class="action clearfix">
                        <a href=' . site_url('/cart/add/'.$product['id']) . ' title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href=' . site_url('/checkout') . ' title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                    </div>
                    </div>
                    </li>';
            }
        } else {
            $output = "<h3>No data found</h3>";
        };
        $output .= '</ul>';
        $paging= '<div class="section-detail">
                    <ul class="list-item clearfix pagging">';
                
        $paging .= $this->paging($total_data, $limit, $page);
        $paging .= '</ul>
        </div>';
        $data['paging']= $paging;
        $data['output'] = $output;
        if($limit> $total_data){
            $data['limit']= $total_data;
        }else{
            $data['limit']= $limit;
        }
        $data['total_data']=$total_data;
        $data['query']= $query.count($result);
        echo json_encode($data);
    }
    function paging($total_data, $limit, $page)
    {
        $total_links = ceil($total_data / $limit);
        $previous_link = '';
        $next_link = '';
        $page_link = '';
        if ($total_links > 6) {
            if ($page < 5) {
                for ($count = 1; $count <= 5; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            } else {
                $end_limit = $total_links - 5;
                if ($page > $end_limit) {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $end_limit; $count <= $total_links; $count++) {
                        $page_array[] = $count;
                    }
                } else {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $page - 1; $count <= $page + 1; $count++) {
                        $page_array[] = $count;
                    }
                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }
        } else {
            for ($count = 1; $count <= $total_links; $count++) {
                $page_array[] = $count;
            }
        }
        if (isset($page_array)) {
            for ($count = 0; $count < count($page_array); $count++) {
                if ($page == $page_array[$count]) {
                    $page_link .= '
                    <li class="active"><a href="#">' . $page_array[$count] . '</a> </li>
                    ';
                    $previous_id = $page_array[$count] - 1;
                    if ($previous_id > 0) {
                        $previous_link = '<li><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Trước</a></li>';
                    } else {
                        $previous_link = ' <li class="disabled"><a class="page-link"  >Trước</a></li> ';
                    }
                    $next_id = $page_array[$count] + 1;
                    if ($next_id > $total_links) {
                        $next_link = ' <li class="disabled"><a class="page-link" >Sau</a></li> ';
                    } else {
                        $next_link = '<li><a  class="page-link" href="#" data-page_number="' . $next_id . '">Sau</a></li>';
                    }
                } else {
                    if ($page_array[$count] == '...') {
                        $page_link .= '<li class="disabled"><a class="page-link" href="#">...</a></li>';
                    } else {
                        $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                        data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>';
                    }
                }
            }
        }
        return $previous_link . $page_link . $next_link;
    }
    function load_blog(){
        $limit=5;
        $page=1;
        if($_POST['page']>1){
            $page= $_POST['page'];
            $start= ($_POST['page']-1) * $limit;
        }else{
            $start= 0;
        }
        $total_data = count(json_decode($this->blog->get_all_post()), true);
        $result = json_decode($this->blog->get_all_post($start, $limit), true);
        $output =' <div class="section" id="list-blog-wp">
                        <div class="section-head clearfix">
                            <h3 class="section-title">Blog</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item">';
        if($total_data>0){
                foreach($result as $item){
                    $output .=' <li class="clearfix">
                                    <a href="'.site_url('/blog/detail_blog/'.$item['id']).'" title="" class="thumb fl-left">
                                        <img src="'.site_url('/public/images/'.$item['img_thumb']).'" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="'.site_url('/blog/detail_blog/'.$item['id']).'" title="" class="title">'.substr($item['title'],0,90).' [...]</a>
                                        <span class="create-date">'.$item['last_update'].'</span>
                                        <p class="desc">'. substr($item['content'],0,300).' [...]</p>
                                    </div>
                                </li>';
                }
        }else{
            $output = "<h3>No data found</h3>";
        }
            $output.=' </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix pagging">';
            $output .= $this->paging($total_data, $limit, $page);
            $output.= '</ul>
                    </div>
                </div>
           ';
            echo $output;
    }
    function update_cart(){
        $id= $_POST['id'];
        $qty= $_POST['qty'];
        $item= json_decode( $this->product->get_product_by_id($id),true);
        if(isset($_SESSION['ismart']['cart']) && array_key_exists($id,$_SESSION['ismart']['cart']['buy'] )){
                $_SESSION['ismart']['cart']['buy'][$id]['qty']=$qty;
                $sub_total= $qty * price_discount($item['price'],$item['discount']);
                $_SESSION['ismart']['cart']['buy'][$id]['sub_total']= $sub_total;
                update_info_cart();
                $total=get_total_cart();
                $data['total']= current_format($total,'Đ');
                $data['sub_total']=current_format($sub_total, 'Đ');  
                $data['num_od']= get_num_od();
        }
        echo json_encode($data);
       
    }
    function keyup_search(){
        $key= $_POST['key'];
        $result= $this->product->search_product($key);
        $total_data = count(json_decode($this->product->search_product($key), true));
        $result = json_decode($this->product->search_product($key), true);
        $output='<ul class="suggest_search">';
        if($total_data > 0 ){
                foreach($result as $item){
                    $output .= '<li class="product_suggest clearfix">
                                    <a href="">
                                        <div class="item-img">
                                            <img src="'.site_url('/public/images/'.$item['product_thumb']).'" alt="">
                                        </div>
                                        <div class="item-info">
                                            <h3>'.$item['product_title'].'</h3>
                                            <p class="item-txt-online">Online giá rẻ</p>
                                            <strong class="price">'.current_format(price_discount($item['price'],$item['discount']),'Đ').'</strong>
                                            <div class="box-p">
                                                <p class="price-old">'.$item['price'].'</p>
                                                <span class="discount">'.$item['discount'].'%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>';
                }
        }else{
            $output= '<p>No data found</p>';
        }
        $output.=' </ul>';
        echo $output;
    }
    function insert_order(){
       
    }
}

