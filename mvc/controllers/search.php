<?php 
class search extends controller{
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
        if(isset($_GET['key']) && $_GET['key'] != ''){
            $list_product= json_decode($this->product->search_no_limit($_GET['key']),true);
            $menu=json_decode($this->menu->get_menu_show(),true);
            $category = json_decode($this->product->get_list_cat(),true);
            $page= json_decode($this->page->get_page(),true);
                $this->view("layout-all",['page'=>'search','category'=>$category, 'list_page'=>$page,
                'menu'=>$menu,'list_product'=>$list_product]);
        }else{
            redirect_to(''.site_url("").''); 
        }
        

    }
}
?>