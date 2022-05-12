<?php
function dd($e){
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
    die();
}
function example() {
    return "Gọi thanh công helper";
}
function site_url($uri){
    return BASE_URL . $uri;
}
function current_format($num, $unit){
    return number_format($num) ." ". $unit;
}
function show_array($arr){
    if(!empty($arr)){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}
function redirect_to($url){
    if(!empty($url)){
        header("location: ".$url);
    }
}
function num_oder()
    {
        if(isset($_SESSION['cart']))
        {
            return $_SESSION['cart']['info']['num_od'];
        }
    }
    function form_error($array=array(),$label_feild){
        if(!empty($array[$label_feild])){
            echo "<p class=error>{$array[$label_feild]}</p>";
        }
    }

    function is_login(){
        if(isset($_SESSION['is_login'])){
            return true;
        }
        return false;
    }
    function user_login(){
        if(!empty($_SESSION['user_login'])){
            return $_SESSION['user_login'];
        }
        return false;
    }
    function set_value($label_feild){
        global $$label_feild;
        if(!empty($$label_feild)){
            return $$label_feild;
        }
    }
    function submit_form($bt){
        if(isset($bt)){
            if(isset($data['error'])){
                $error_form=$data['error'];
            }
            if(isset($data['msg'])){
                if($data['msg']== true){
                    $msg= "Success!";
                }else{
                    $msg= "Failed!";
                }
            }
            }
    }
    function value_status($a){
        if($a==2){
            $op= "Đã đăng";
        }else{
            $op= "Chờ duyệt";
        }
        return $op;
    }

?>