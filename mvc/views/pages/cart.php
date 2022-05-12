<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?=site_url("")?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?= site_url("/cart")?>" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $list_cart= get_list_buy_cart();
                        $info_cart= get_info_buy_cart();
                        if(!empty($list_cart)){
                            foreach($list_cart as $item){
                    ?>
                        <tr>
                            <td><?=$item['code']?></td>
                            <td>
                                <a href="" title="" class="thumb">
                                    <img src="<?=site_url("/public/images/".$item['product_thumb']."")?>" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="" title="" class="name-product"><?= $item['product_title']?></a>
                            </td>
                            <td><?= current_format($item['price'],'Đ')?></td>
                            <td>
                                <input min='1' max='10' data-id="<?=$item['id']?>"  type="number" name="num-order" value="<?=$item['qty']?>" class="num-order">
                            </td>
                            <td id="sub-total-<?=$item['id']?>"><?= current_format($item['sub_total'],'Đ')?></td>
                            <td>
                                <a href="<?=$item['url_delete']?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php  
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?=current_format($info_cart['total'],'Đ')?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                        <a href="<?=site_url("/checkout")?>" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                    <?php      
                        }else{
                    ?>
                         <tr><td colspan="7" align="center" >No Data Found</td></tr>
                    <?php  
                    } ?>           
                    
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="<?=site_url("")?>" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="<?=site_url("/cart/del")?>" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>