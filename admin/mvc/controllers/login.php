<?php
class login extends controller
{
    public $user;
    function __construct()
    {
        $this->user = $this->model("user");
    }
    function index()
    {
        $this->view("layout-login", ["page" => "login"]);
    }
    function checklogin()
    {
        // 1. get data khach hang login 
        if (isset($_POST['btn-login'])) {
                 $error_form = array();
            // ! kiểm tra điều kiện !empty
            if (empty($_POST['username'])) {
                $error_form['username'] = 'Vui lòng nhập tài khoản';
            } else {
                $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
                $subject = $_POST['username'];
                !preg_match($partten, $subject, $matchs) ? $error_form['username'] = 'Username có độ dài từ 6 đến 32 kí tự' : $username = $_POST['username'];
            }
            if (empty($_POST['password'])) {
                $error_form['password'] = 'Vui lòng nhập mật khẩu';
            } else {
              //  $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                 $pattern = '/^(?=.*[A-Z]).{8,}$/';  
                 $subject = $_POST['password'];
                !preg_match($pattern, $subject, $matchs) ? $error_form['password'] = 'Password sai định dạng. Vui lòng nhập lại password!' : $password = $_POST['password'];
            }
        }
        
        //check database
        if(!empty($password) && !empty($username)){
            $kq = $this->user->checkuser($username, $password);
        }
        $fn= $this->user->get_fullname($_POST['username']);   
      
        if (empty($error_form) &&$kq == 'true'){   
                $_SESSION['is_login']=true;
                $_SESSION['user_login']=$fn['fullname'];  
                $_SESSION['username']= $username;
                redirect_to(site_url("/home"));
            
        } else {
            $error_form['account'] = 'Tài khoản hoặc mật khẩu không đúng';
            $this->view("layout-login",
            ["page"=>"login",
            "error"=>$error_form]);
        }
    }
    function logout(){
        unset($_SESSION);
        

        redirect_to(site_url(" "));
    }

}
