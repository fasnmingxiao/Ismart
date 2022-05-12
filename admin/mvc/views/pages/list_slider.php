<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="<?=site_url("/slider/add")?>" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count"></span></a> |</li>
                            <li class="publish"><a href="">Công khai <span class="count"></span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count"></span></a></li>
                        </ul>
                    </div>
                    <div class="actions">
                            <select name="actions" class="status">
                                <option value="">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="2">Chờ duyệt</option>
                            </select>
                    </div>
                    <div id="table1" class="table-responsive">
                            
                                
                               
                    </div>  
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        load_data_slider(1);
        $('.status').change(function(){
            var qr = $('.status').val();
                load_data_slider(1,qr);
        });
        $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var qr = $('.status').val();
                load_data_slider(page, qr);
            })
            
    })
    
</script>