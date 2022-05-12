<?php 
class blog extends controller{
    public $blog;
    function __construct()
    {
        $this->blog=$this->model("blogM");
    }
    function index(){
        $this->view("layout-all",['page'=>'list_post']);
    }
    function add(){
        $this->view("layout-all",['page'=>'add_post']);
    }
}
?>