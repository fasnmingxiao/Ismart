<?php
class register extends controller
    
{
    public $user;
    function __construct()
    {
        $this->user=$this->model("user");
    }
    function index()
    {
        
        $this->view("layout-login", ["page" => "register"]);
    }
    function checkreg(){
        if (isset($_POST['btn-reg'])) {
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
                !preg_match($pattern, $subject, $matchs) ? $error_form['password'] = 'Password sai định dạng. Vui lòng nhập lại password!' : $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
            }
            if (empty($_POST['fullname'])) {
                $error_form['fullname'] = 'Vui lòng nhập họ và tên';
            } else {
                $fullname = $_POST['fullname'];
            }
            if (empty($_POST['email'])) {
                $error_form['email'] = 'Vui lòng nhập email';
            } else {
                $email = $_POST['email'];
            }
            if(empty($_POST['phonenb'])){
                $error_form['phonenb']='Vui lòng nhập số điện thoại của bạn';
            }else{
                $pattern = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';
                $subject = $_POST['phonenb'];
                !preg_match($pattern, $subject, $matchs) ? $error_form['phonenb'] = 'Số điện thoại sai định dạng!' : $phonenb = $_POST['phonenb'];
            }
        }
        if(empty($error_form)){
            $token = md5($username.time());
            $this->user->insert_user($fullname,$username,$password,$email,$phonenb,$token);
            $link_active= site_url("/register/active/$token");
            $content= "<p>Xin chào {$fullname}</p>
            <p>Bạn đã đăng ký thành công tài khoản trên fb. Để hoàn tất việc tạo tài khoản mới của bạn, hãy nhấp vào <a href='$link_active'>ĐÂY</a> hoặc liên kết dưới đây để xác minh địa chỉ Email của bạn: </p>
            <p>$link_active</p>
            <p>Trân trọng</p>
            ";
           send_mail($email,$fullname,'Kích hoạt tài khoản',$content);
           echo "email đã được gửi đi . Bấm vào <a href='https://mail.google.com/'>Đây</a> để xác minh tài khoản và trở thành thành viên của pohub";
        }else{
            $this->view("layout-login", ["page" => "register","error"=>$error_form]);
        }

    }
    function active($token){
        if($this->user->active_user ($token)){
            $alert="Acvite account success!";
        }else{
            $alert="Acvite account failer!";
        }
        
        $this->view("active",["page"=>"alert","alert"=>$alert]);
    }
}
