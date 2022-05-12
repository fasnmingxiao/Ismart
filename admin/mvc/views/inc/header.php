<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý ISMART</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= site_url("/public/css/bootstrap/bootstrap.min.css")?>" rel="stylesheet" type="text/css"/>
        
        <link href="<?= site_url("/public/css/bootstrap/bootstrap-theme.min.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("/public/css/reset.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?=site_url("/public/css/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("/public/css/style.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("/public/css/responsive.css")?>" rel="stylesheet" type="text/css"/>

        <script src="<?=site_url("/public/js/jquery-2.2.4.min.js")?>" type="text/javascript"></script>
        <script src="<?=site_url("/public/js/bootstrap/bootstrap.min.js")?>" type="text/javascript"></script>
        <script src="<?=site_url("/public/js/jquery.validate.min.js")?>" type="text/javascript"></script>
        <script src="<?=site_url("/public/js/plugins/ckeditor/ckeditor.js")?>" type="text/javascript"></script>
        <script src="<?= site_url("/public/js/main.js")?>" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="<?= site_url("/home")?>" title="" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="<?=site_url("/list_post")?>" title="">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?=site_url("/list_post/add")?>" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="<?=site_url("/list_post/cat")?>" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=list_post" title="">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=add_post" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_post" title="">Danh sách bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_cat" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?=site_url("/list_product")?>" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?=site_url("/list_product/add")?>" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="<?=site_url("/list_product")?>" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="<?=site_url("/list_product/cat")?>" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?=site_url("/list_order")?>" title="">Danh sách đơn hàng</a> 
                                    </li>
                                    <li>
                                        <a href="<?=site_url("/list_customer")?>" title="">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?=site_url("/menu")?>" title="">Menu</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="<?= site_url("/public/images/img-admin.png")?>">
                                </div>
                                <h3 id="account" class="fl-right"><?php 
                                if(isset($_SESSION['is_login'])){echo $_SESSION['user_login'];} 
                                ?></h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url("/info_account")?>" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href="<?= site_url("/login/logout")?>" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>