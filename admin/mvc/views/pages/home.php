<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <?php if (isset($_SESSION['is_login'])) { ?>
                    <div class="clearfix">
                        <h3 id="index" class="text-center">Xin chào <?= $_SESSION['user_login'] ?> đến với trang quản trị viên</h3>
                        
                    </div>
                <?php } 
                
                ?>
            </div>
        </div>
    </div>
</div>