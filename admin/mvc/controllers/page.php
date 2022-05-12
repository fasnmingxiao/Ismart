<?php 
class page extends controller{
    function __construct()
    {
        
    }
    function index()
    {
        $this->view("layout-all",['page'=>'list_page']);
    }
    function add_page()
    {
        $this->view("layout-all",['page'=>'add_page']);
    }
}
?>