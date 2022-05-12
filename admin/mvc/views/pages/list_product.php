<?php
if (!empty($data['pages'])) {
    $page = $data['pages'];
} else {
    $page = 1;
};
if(isset($data['msg'])){
    if($data['msg']== true){
        $msg= "Success!";
    }else{
        $msg= "Failed!";
    }
}
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section d-flex f-center justify-content-between" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="<?= site_url("/product") ?>" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                <div class="wp_search_box">
                    <p>Search</p>
                    <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a data-idnum="0" href="javascript:void(0)">Tất cả <span class="count"></span></a> |</li>
                            <li class="publish"><a data-idnum="2" href="javascript:void(0)">Đã đăng <span class="count"></span></a> |</li>
                            <li class="pending"><a data-idnum="1" href="javascript:void(0)">Chờ xét duyệt<span class="count"></span> |</a></li>
                        </ul>
                    </div>
                    <div class="table-responsive">


                        </ul>
                    </div>
                    <div class="msg"><?php echo isset($msg)? $msg : false  ?></div>
                </div>
                
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            load_data_product(1);
            $('#search_box').keyup(function() {
                var qr = $('#search_box').val();
                load_data_product(1, qr);
            })
            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var qr = $('#search_box').val();
                load_data_product(page, qr);
            })
            $(".post-status li a").on('click', function() {
                id = $(this).data('idnum');
                qr = $('#search_box').val();
                load_data_product(1,qr,id);
            });
        });
    </script>