<?php 
class product extends controller{
    public $product;
    public $menu;
    public $page;
    function __construct()
    {
        $this->product=$this->model("productM");
        $this->page=$this->model("pageM");
        $this->menu=$this->model("menuM");
    }    
    function index(){
        $list_product= json_decode($this->product->show_all_product_with_cat_id(),true);
        $menu=json_decode($this->menu->get_menu_show(),true);
        $category = json_decode($this->product->get_list_cat(),true);
        $page= json_decode($this->page->get_page(),true);
        $this->view("layout-all",['page'=>'all_cat_product','category'=>$category, 'list_page'=>$page,
        'menu'=>$menu,'list_product'=>$list_product]);
    }
    function category_product($id=''){
        if($id== null){
            redirect_to(''.site_url("/errorpage").'');
        }else{
            // $list_product= json_decode($this->product->show_product_by_cat_id($id),true);
            $menu=json_decode($this->menu->get_menu_show(),true);
            $category = json_decode($this->product->get_list_cat(),true);
            $page= json_decode($this->page->get_page(),true);
            $this->view("layout-all",['page'=>'category_product','category'=>$category, 'list_page'=>$page,
            'menu'=>$menu,'id'=>$id]);
        }
    }
    function detail_product($id=''){
        if($id== null){
            redirect_to(''.site_url("/errorpage").'');
        }else{
            $product=json_decode($this->product->get_product_by_id($id),true);
            $menu=json_decode($this->menu->get_menu_show(),true);
            $category = json_decode($this->product->get_list_cat(),true);
            $page= json_decode($this->page->get_page(),true);
            $this->view("layout-all",['page'=>'detail_product','category'=>$category, 'list_page'=>$page,
            'menu'=>$menu,'id'=>$id,'product'=>$product]);
        }
    }
}
?>