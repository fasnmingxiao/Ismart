<?php
class errorpage extends controller{
    function __construct()
    {
        
    }
    function index(){
        $this->view("error",['page'=>'']);
    }
}
?>