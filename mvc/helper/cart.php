<?php 
function add_cart($id,$data=[]){
    $data;
    $qty=1;
    if(isset($_SESSION['ismart']['cart']) && array_key_exists($id, $_SESSION['ismart']['cart']['buy'])){
            $qty = $_SESSION['ismart']['cart']['buy'][$id]['qty']+ 1;
    }
    
    $_SESSION['ismart']['cart']['buy'][$id]= array(
            'id' => $data['id'],
            'code' => $data['code'],
            'product_title'=> $data['product_title'],
            'price' => price_discount($data['price'],$data['discount']),
            'product_thumb' => $data['product_thumb'],
            'url'=> site_url("/product/detail_product/".$data['id'].""),
            'qty' => $qty,
            'sub_total' => $qty* price_discount($data['price'],$data['discount'])
    );

update_info_cart();
    
}
function update_info_cart(){
  if(isset($_SESSION['ismart']['cart'])){
    $num_od = 0;
    $total =0 ;
    foreach($_SESSION['ismart']['cart']['buy'] as $item){
        $num_od += $item['qty'];
        $total += $item['sub_total'];
    }
    $_SESSION['ismart']['cart']['info'] = array(
        'num_od' => $num_od,
        'total' => $total
    );
    
  }

};
function get_num_od(){
    if(isset($_SESSION['ismart']['cart'])){
        return $_SESSION['ismart']['cart']['info']['num_od'];
    }
}
function get_info_buy_cart(){
    if(isset($_SESSION['ismart']['cart'])){
        return $_SESSION['ismart']['cart']['info'];      
    }else{
        return false;
    }
}
function get_list_buy_cart(){
    if(isset($_SESSION['ismart']['cart'])){
        foreach($_SESSION['ismart']['cart']['buy'] as &$item){
            $item['url_delete']= site_url("/cart/del/{$item['id']}");
        }
        return $_SESSION['ismart']['cart']['buy'];
    }else{
        return false;
    }
}
function delete_item($id =""){
    if(isset($_SESSION['ismart']['cart'])){
        if(!empty($id)){
            unset($_SESSION['ismart']['cart']['buy'][$id]);
            update_info_cart();
        }else{
            unset($_SESSION['ismart']['cart']);
            update_info_cart();
        }
    } 
}
function get_total_cart(){
    if(isset($_SESSION['ismart']['cart'])){
        return $_SESSION['ismart']['cart']['info']['total'];
    }
    return false;
}
?>