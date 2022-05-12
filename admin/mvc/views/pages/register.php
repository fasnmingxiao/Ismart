<?php 
$error_form= array();
if(isset($_POST['btn-reg'])){
    $error_form=$data['error'];
}
?>
<html>
<head>
    <title>Trang đăng ký</title>
</head>
<link href="<?= site_url("/public/css/resert.css")?>" rel="stylesheet" type="text/css" />
<link href="<?= site_url("/public/css/login.css")?>" rel="stylesheet" type="text/css" />


<body>
    <div id="wrapper-form-login">
        <form action="<?= site_url("/register/checkreg")?>" id="form-login" method="POST">
            <h1>Register</h1>
            <input type="text" id="username" name="username" placeholder="Username" value="">
            <p class="error"></p>
            <input type="password" name="password" id="password" placeholder="Password" value="">
            <?php form_error($error_form,'password')?>
            <input type="text" id="fullname" name="fullname" placeholder="Fullname" value="">
            <?php form_error($error_form,'fullname')?>
            <input type="email" id="email" name="email" placeholder="Email" value="">
            <?php form_error($error_form,'email')?>
            <input type="text" id="phonenb" name="phonenb" placeholder="Phonenumber" value="">
            <?php form_error($error_form,'phonenb')?>
            <input type="submit" value="Register" name="btn-reg" id="btn-login">
            <p>Bạn đã có tài khoản? <a href="<?= site_url("/login")?>" id="lost-pass">Đăng nhập</a></p>
        </form>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src=<?=site_url("/public/js/main.js")?>></script>
</body>
</html>