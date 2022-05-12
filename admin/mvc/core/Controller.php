<?php 
class controller{
    function model($model){
        require "./mvc/models/".$model.".php";
        return new $model;
    }
    function view($view, $data= []){
    require_once "./mvc/views/".$view.".php";
    }
}
?>