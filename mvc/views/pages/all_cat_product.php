<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <!-- <div class="filter-wp clearfix">
                    <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                    <div class="form-filter float-end">
                        <form method="POST" action="">
                            <select name="select">
                                <option value="0">Sắp xếp</option>
                                <option value="1">Từ A-Z</option>
                                <option value="2">Từ Z-A</option>
                                <option value="3">Giá cao xuống thấp</option>
                                <option value="3">Giá thấp lên cao</option>
                            </select>
                            <button type="submit">Lọc</button>
                        </form>
                    </div>
                </div> -->

                <?php foreach($data['category'] as $value){
                    if ($value['ParentCatID'] == 0){
                ?>
                <div class="clearfix">
                    <div class="section-head d-flex justify-content-between">
                        <div>
                        <h3 class="section-title "><?= $value['Name'] ?></h3>
                        </div>
                        <div>
                        <a class="clearfix button-1 " href="<?=site_url("/product/category_product/".$value['cat_id']."")?>"><p>Xem thêm</p></a>
                        </div>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">        
                <?php
                        foreach($data['list_product'] as $product){
                            if ($product['ParentCatID'] == $value['cat_id']){
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
                } ?>
            </div>   
            
        </div>
        
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
            <div class="section" id="filter-product-wp">
                <!-- <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Acer</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Apple</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Hp</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Lenovo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Samsung</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Toshiba</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div> -->
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