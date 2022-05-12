<?php 
$error_form= array();
if(isset($_POST['btn-login'])){
    $error_form=$data['error'];
}
?>
<html>
<head>
    <title>Admin login</title>
</head>
<link href="<?= site_url("/public/css/resert.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?= site_url("/public/css/login.css") ?>" rel="stylesheet" type="text/css" />
<body>
    <div id="wrapper-form-login">
        <form action="<?= site_url("/login/checklogin") ?>" id="form-login" method="POST">
            <h1>Login</h1>
            <?php  
                if(isset($data['text'])){
                    echo $data['text'];
                    }
            ?>
            <input type="text" id="username" name="username" placeholder="Username" value="">
            <?php form_error($error_form,'username') ?>
            <input type="password" name="password" id="password" placeholder="Password" value="">
            <?php form_error($error_form,'password')?>
            <input type="submit" value="Login" name="btn-login" id="btn-login">
            <?php form_error($error_form,'account') ?>
            
            <a href="<?= site_url("/resertpw")?>" id="lost-pass">Quên mật khẩu ?</a>
            <p>Bạn chưa có tài khoản? <a href="<?= site_url("/register") ?>" id="lost-pass">Đăng ký</a></p>
        </form>
        
    </div>
</body>
</html>