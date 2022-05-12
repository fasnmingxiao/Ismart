<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                </div>
                <div class="section-detail" id="main-product">
                <ul class="list-item clearfix">
                <?php if(!empty($data['list_product'])){
                    foreach($data['list_product'] as $product){
                ?>
                    <li class="wp-product-item">
                    <div>
                    <a href="<?=site_url('/product/detail_product/' . $product["id"])?>" title="" class="thumb">
                    <img src='<?=site_url('/public/images/' . $product["product_thumb"])?>'>
                    </a>
                    <a class="product-name" href='<?=site_url('/product/detail_product/' . $product["id"])?>'><?=substr($product["product_title"],0,50) ?>
                    </a>
                    </div>
                    <div>
                    <div class="price">
                        <span class="new"><?=current_format(price_discount($product["price"], $product["discount"]), "Đ")?></span>
                        <span class="old"><?=current_format($product["price"], "Đ")?></span>
                    </div>
                    <div class="action clearfix">
                        <a href="<?=site_url('/cart/add/'.$product['id'])?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="<?=site_url('/checkout')?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                    </div>
                    </div>
                    </li>
                <?php        
                    }
                }else{
                    show_array($_SESSION['ismart']);
                ?>
                <p>No data found :((</p>
                <?php    
                }
                ?>
                </ul>
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
