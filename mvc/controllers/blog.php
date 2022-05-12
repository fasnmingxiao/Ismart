<?php 
    class blog extends controller{
        public $blog;
        public $menu;
        public $page;
        function __construct()
        {
            $this->blog=$this->model("blogM");
            $this->page=$this->model("pageM");
            $this->menu=$this->model("menuM");
            $this->product=$this->model("productM");
        }
        function index(){
            $list_product= json_decode($this->product->show_all_product_with_cat_id(),true);
            $menu=json_decode($this->menu->get_menu_show(),true);
            $category = json_decode($this->product->get_list_cat(),true);
            $list_sale_product= $list_product;
            $page= json_decode($this->page->get_page(),true);
            $view=array_column($list_product,'view');
            $blog= json_decode($this->blog->get_all_post(),true);
            array_multisort($view,SORT_DESC,$list_sale_product);
            $this->view("layout-all",['page'=>"blog",'menu'=>$menu, 'list_page'=>$page,'category'=>$category,'list_sale_product'=>$list_sale_product,'blog'=>$blog]);

        }
        function detail_blog($id=''){
                if(($id == null)){
                    redirect_to(''.site_url("/errorpage").'');  
                }else{
                    $list_product= json_decode($this->product->show_all_product_with_cat_id(),true);
                    $menu=json_decode($this->menu->get_menu_show(),true);
                    $category = json_decode($this->product->get_list_cat(),true);
                    $page= json_decode($this->page->get_page(),true);
                    $list_sale_product= $list_product;
                    $view=array_column($list_product,'view');
                    array_multisort($view,SORT_DESC,$list_sale_product);
                    $blog= json_decode($this->blog->get_post_by_id($id),true);
                    $this->view("layout-all",['page'=>'detail_blog','category'=>$category, 'list_page'=>$page,
                    'menu'=>$menu,'id'=>$id,'list_sale_product'=>$list_sale_product,'blog'=>$blog]);
                }
        }
    }

?>