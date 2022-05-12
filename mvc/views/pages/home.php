<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <!-- ==============================SLIDER================================= -->
            <?php if (!empty($data['slider'])) { ?>
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <?php foreach ($data['slider'] as $slider) { ?>
                            <div class="item">
                                <img src="<?= site_url($slider['image']) ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <!-- =========================END SLIDER================================= -->
            <!-- ==========================LIST SUPPORT============================= -->
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ===========================END LIST SUPPORT========================= -->
            <!-- ============================LIST FEATURE PRODUCT==================== -->
            <!-- 10 sản phẩm có view cao nhất -->
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php $fp = 1;
                        foreach ($data['list_product'] as $feature_product) { ?>
                            <li class="wp-product-item">
                                <div>
                                    <a href="<?= site_url("/product/detail_product/" . $feature_product['id'] . "") ?>" title="" class="thumb">
                                        <img src="<?= site_url("/public/images/" . $feature_product['product_thumb'] . "") ?>">
                                    </a>
                                    <a href="<?= site_url("/product/detail_product/" . $feature_product['id'] . "") ?>" title="" class="product-name"><?= $feature_product['product_title'] ?></a>
                                </div>
                                <div>
                                    <div class="price">
                                        <span class="new"><?= current_format(price_discount($feature_product['price'], $feature_product['discount']), 'Đ') ?></span>
                                        <span class="old"><?= current_format($feature_product['price'], 'Đ') ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?=site_url("/cart/add/".$feature_product['id']."")?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?=site_url("/checkout")?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </div>
                            </li>
                        <?php $fp++;
                            if ($fp > 6) {
                                break;
                            }
                        } ?>

                    </ul>
                </div>
            </div>
            <!-- ============================END LIST FEATURE PRODUCT==================== -->
            <!-- ============================LIST PRODUCT BY CAT_ID==================== -->
            <?php
            // VÒNG LẶP TÊN LOẠI SẢN PHẨM ===========================
            foreach ($data['category'] as $value) {
                // CHECK ĐIỀU KIỆN LÀ CATEGORY ĐỘC LẬP=================
                if ($value['ParentCatID'] == 0) {
            ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><?= $value['Name'] ?></h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php
                                //VÒNG LẶP SẢN PHẨM CÓ CATEGORY = CATEGORY Ở TRÊN
                                $num = 1;
                                foreach ($data['list_product'] as $product) {

                                    if ($product['ParentCatID'] == $value['cat_id']) {
                                        $num++;
                                        if ($num > 5) {
                                            break;
                                        }
                                ?>
                                        <li class="wp-product-item">
                                            <a href="<?= site_url("/product/detail_product/".$product['id']."")?>" title="" class="thumb">
                                                <img src="<?= site_url("/public/images/" . $product['product_thumb'] . "") ?>">
                                            </a>
                                            <a href="<?= site_url("/product/detail_product/".$product['id']."")?>" title="" class="product-name"><?= $product['product_title'] ?></a>
                                            <div class="price">
                                                <span class="new"><?= current_format(price_discount($product['price'], $product['discount']), 'Đ') ?></span>
                                                <span class="old"><?= current_format($product['price'], 'Đ') ?></span>
                                            </div>
                                            <div class="action clearfix">
                                                <a href="<?=site_url("/cart/add/".$product['id']."")?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                <a href="<?=site_url("/checkout")?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                            </div>
                                        </li>

                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
            <?php
                }
            }
            // KẾT THÚC VÒNG LẶP TÊN LOẠI SẢN PHẨM 
            ?>
            <!-- ============================LIST PRODUCT BY CAT_ID==================== -->
        </div>
        <!-- ============================SIDEBAR ==================================-->
        <div class="sidebar fl-left">
            <!-- =============================MENU===================================== -->
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
            <!-- =============================END MENU================================= -->
            <!--====================== SALE PRODUCT================================== -->
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php $num_sale = 1;
                        foreach ($data['list_sale_product'] as $sale) { ?>

                            <li class="clearfix">
                                <a href="<?= site_url("/product/detail_product/" . $sale['id'] . "") ?>" title="" class="thumb fl-left">
                                    <img src="<?= site_url("/public/images/" . $sale['product_thumb'] . "") ?>" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="<?= site_url("/product/detail_product/" . $sale['id'] . "") ?>" title="" class="product-name"><?= $sale['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?= current_format(price_discount($sale['price'], $sale['discount']), 'Đ') ?></span>
                                        <span class="old"><?= current_format($sale['price'], 'Đ') ?></span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        <?php
                        } ?>
                    </ul>
                </div>
            </div>
            <!-- ========================END SALE PRODUCT================================= -->
            <!-- ================ADS========================================= -->
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
            <!-- ==================END ADS====================================== -->
        </div>
        <!-- ============================ END SIDEBAR ==================================-->
    </div>
</div>