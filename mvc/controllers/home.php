<?php 
class home extends controller{
        public $page;
        public $product;
        public $slider;
        public $menu;
    function __construct()
    {
        $this->product=$this->model("productM");
        $this->page=$this->model("pageM");
        $this->slider=$this->model("sliderM");
        $this->menu=$this->model("menuM");
    }
    function index()
    {   
        $list_product= json_decode($this->product->show_all_product_with_cat_id(),true);
        $slider= json_decode($this->slider->get_list_slider_show(),true);
        $category = json_decode($this->product->get_list_cat(),true);
        $menu=json_decode($this->menu->get_menu_show(),true);
        $page= json_decode($this->page->get_page(),true);
        $list_sale_product= $list_product;
        $discount=array_column($list_product,'discount');
        array_multisort($discount,SORT_ASC,$list_sale_product);
        $this->view("layout-all",['page'=>'home', 'list_page'=>$page,'category'=>$category,'list_product'=>$list_product,'slider'=>$slider,'list_sale_product'=>$list_sale_product,'menu'=>$menu]);
    }
}
?>