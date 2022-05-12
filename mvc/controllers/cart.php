<?php 
class cart extends controller{
    public $product;
    public $page;
    function __construct()
    {
        $this->product= $this->model("productM");
        $this->page=$this->model("pageM");
    }
    function index(){  
        $page= json_decode($this->page->get_page(),true);    
        $this->view("layout-all",['page'=>'cart','list_page'=>$page]);
    }
    function add($id){
        $product= json_decode($this->product->get_product_by_id($id),true);
        add_cart($id,$product);
        redirect_to(''.site_url("/cart").'');
    }
    function del($id=''){
        delete_item($id);
        redirect_to(''.site_url("/cart").'');
    }

}

?>