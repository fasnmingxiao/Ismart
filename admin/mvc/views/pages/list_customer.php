<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count"></span></a></li>
                        </ul>
                        <div class="wp_search_box">
                            <p>Search</p>
                            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
                        </div>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Xóa</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">




                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            load_data_customer(1);
            $("#search_box").keyup(function(){
               var qr= $(this).val();
                load_data_customer(1,qr)
            })
            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var qr = $('#search_box').val();
                load_data_product(page, qr);
            })
        })
    </script>