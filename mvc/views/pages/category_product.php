<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?= site_url("")?>" title="">Trang chủ</a>
                    </li>
                    <?php
                    foreach ($data['category'] as $breadcrumb) {
                        if ($breadcrumb['cat_id'] == $data['id']) {
                    ?>
                            <li>
                                <a href="<?= site_url("/product/category_product/" . $breadcrumb['cat_id'] . "") ?>" title=""><?= $breadcrumb['Name'] ?></a>
                            </li>
                    <?php
                            break;
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                <?php
                    foreach ($data['category'] as $breadcrumb) {
                        if ($breadcrumb['cat_id'] == $data['id']) {

                    ?>
                            <h3 data-id="<?= $breadcrumb['cat_id']?>" class="section-title cat-product fl-left"><?= $breadcrumb['Name'] ?></h3>
                    <?php
                            break;
                        }
                    }
                    ?>
                    
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select" id="sort">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail" id="main-product">
                    <!-- ========================================DATA PRODUCT====================================== -->
                </div>
            </div>
            <div class="section" id="paging-wp">
                 <!-- ======================DATA PAGING================================= -->
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <?php
                        echo_menu($data['menu']);
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <div class="list-group shadow-none">
                        <h3 class="h3">Price</h3>
                        <input type="hidden" id="hidden_minimum_price" value="0" />
                        <input type="hidden" id="hidden_maximum_price" value="65000" />
                        <p id="price_show">1.000.000 - 65.000.000</p>
                        <div id="price_range"></div>
                    </div>
                    <div class="list-group shadow-none mt-4">
                        <h3 class="h3">Brand</h3>
                        <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                            <?php
                            foreach ($data['category'] as $brand) {
                                if ($brand['ParentCatID'] == $data['id']) {
                            ?>
                                    <div class="form-check">
                                        <input class="form-check-input common_selector brand" class="" type="checkbox" value="<?= $brand['cat_id']; ?>" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        <?= $brand['Name']; ?> 
                                        </label>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                 
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        load_list_product(1);
        function load_list_product(page) {
            $("#main-product").html("<div class='loader simple-circle'></div>");
            var id= $(".cat-product").data("id");    
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var brand = get_filter('brand');
            var sort = $('#sort').val();
            $.ajax({
                url: "http://localhost/Ismart/ajax/load_product_by_category",
                method: "POST",
                data: {
                    id: id,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    page:page,
                    sort:sort
                },
                success: function(data) {
                    var obj= $.parseJSON(data);
                    $("#main-product").html(obj.output);
                    $("#paging-wp").html(obj.paging);
                    $('.desc').html("Hiển thị "+obj.limit+ " trên " +obj.total_data+ " sản phẩm ");
                    console.log(obj.query);
                }
            })
        };
        $('.common_selector').click(function(){
            load_list_product(1);
        });
        $('#sort').on('change', function() {
        load_list_product(1);
        });
        $('#price_range').slider({
            range: true,
            min: 1000000,
            max: 65000000,
            values: [1000000, 65000000],
            step: 500,
            stop: function(event, ui) {
                $('#price_show').html((ui.values[0]).toLocaleString() + ' - ' + (ui.values[1]).toLocaleString(  ));
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                load_list_product();
            }
        });
      
    })
</script>