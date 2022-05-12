<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count"></span></a> |</li>
                            <li class="publish"><a href="">Chờ duyệt<span class="count"></span></a> |</li>
                            <li class="pending"><a href="">Đang vận chuyển<span class="count"></span> |</a></li>
                            <li class="done"><a href="">Thành công<span class="count"></span></a></li>
                        </ul>
                        <div class="wp_search_box">
                        <p>Search</p>
                        <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
                    </div>
                    </div>
                    <div class="table-responsive" id="tab-deal">
                            
                            
                                
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        load_deal(1);
        $("#search_box").keyup(function(){
            qr= $(this).val();
            load_deal(1,qr);
        })
        $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var qr = $('#search_box').val();
                load_data(page, qr);
            });
        $(".post-status li a").on('click', function() {
                id = $(this).data('idnum');
                qr = $('#search_box').val();
                load_data_product(1,qr,id);
            });
    })

</script>