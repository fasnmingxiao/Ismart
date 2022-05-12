<?php
class info_account extends controller{
    public $user;
    function __construct()
    {
        $this->user=$this->model("User");
    }
    function index(){
        $account=$this->user->admin_by_un($_SESSION['username']);
        $this->view("layout-all",["page"=>"info_account","account"=>$account]);
    }
    function changePassword(){
        $this->view("layout-all",["page"=>"changePassword"]);
    }
}
?>