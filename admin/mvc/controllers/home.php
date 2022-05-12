<?php 
class home extends controller{
    function __construct()
    {
    }
    function index(){
        $this->view("layout-all",['page'=>'home']);
    }
}
?>