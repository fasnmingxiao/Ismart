<?php 
$data=json_decode($data['account'],true);
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="<?= site_url("/info_account/changePassword")?>" title="">Đổi mật khẩu</a>
                </li>
                <li>
                    <a href="<?= site_url("/login/logout")?>" title="">Thoát</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="display-name" value="<?= $data['fullname']?>" id="display-name">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" value="<?= $data['username']?>" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?= $data['email']?>" id="email">
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" value="<?= $data['phone']?>" id="tel">
                        
                        <button type="submit" name="btn-submit" id="btn-update-account">Cập nhật</button>
                        <p id="update-text"></p>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>
</div>