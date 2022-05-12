<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="<?= site_url("/blog/add")?>" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                            <li class="all"><a data-idnum="0" href="javascript:void(0)">Tất cả <span class="count"></span></a> |</li>
                            <li class="publish"><a data-idnum="1" href="javascript:void(0)">Đã đăng <span class="count"></span></a> |</li>
                            <li class="pending"><a data-idnum="2" href="javascript:void(0)">Chờ xét duyệt<span class="count"></span> |</a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                        <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Chỉnh sửa</option>
                                <option value="2">Bỏ vào thủng rác</option>
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
    $(document).ready(function(){
        load_list_blog(1);

        $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var qr = $('#search_box').val();
                load_list_blog(page, qr);
            })
            $(".post-status li a").on('click', function() {
                id = $(this).data('idnum');
                qr = $('#search_box').val();
                load_list_blog(1,qr,id);
            });
    })

</script>