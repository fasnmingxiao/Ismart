<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                    <li class="disabled">
                        <a href="" title=""><?= $data['blog']['title']?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?= $data['blog']['title']?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?= $data['blog']['last_update']?></span>
                    <div class="detail">
                       
                        <p><?= $data['blog']['content']?></p>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
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
                        <?php $num_sale++; 
                        if( $num_sale>6 ){
                            break;
                        }
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="<?= site_url("/public/images/banner.png")?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>