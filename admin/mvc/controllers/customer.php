<?php 
class customer extends controller{
        public $customer;
        function __construct()
        {
            $this->customer=$this->model("customerM");
        }
        function index(){
            $this->view("layout-all",['page'=>'list_customer']);
        }
}
?>