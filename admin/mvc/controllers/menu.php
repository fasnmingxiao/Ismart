<?php 
class menu extends controller{
    public $menu;
    function __construct()
    {
        $this->menu=$this->model("menuM");
    }
    function index(){
        $parent= json_decode($this->menu->get_parent_url_dropdown(),true);
        $this->view("layout-all",['page'=>'menu','parent'=>$parent]);
    }
}
?>