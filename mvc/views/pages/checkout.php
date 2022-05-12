<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="<?=site_url("/checkout/check")?>" id="form-checkout" name="form-checkout">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên <span style="color:red">(*)</span></label>
                            <input type="text" name="fullname" id="fullname" required>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email <span style="color:red">(*)</span></label>
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ <span style="color:red">(*)</span></label>
                            <input type="text" name="address" id="address" required>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại <span style="color:red">(*)</span></label>
                            <input type="tel" name="phone" id="phone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col ">
                            <label for="notes">Thanh toán :</label>
                            <select name="payment" id="payment" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                            <option >Chọn phương thức thanh toán</option>
                            <option value="1">Nhận hàng thanh toán</option>
                            <option value="2">Thanh toán tại cửa hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="place-order-wp ">
                    <input type="submit" name="order-now" id="order-now" value="Đặt hàng">
                    </div>
                </form>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $list_cart= get_list_buy_cart();
                        $info_cart= get_info_buy_cart();
                        if(!empty($list_cart)){
                            foreach($list_cart as $item){
                    ?>
                        <tr class="cart-item">
                            <td class="product-name"><?=$item['product_title']?><strong class="product-quantity">x <?=$item['qty']?></strong></td>
                            <td class="product-total"><?= current_format($item['sub_total'],'Đ')   ?></td>
                        </tr>
                    <?php            
             
                            }}
                    ?>
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price"><?php  echo current_format(get_total_cart(),'Đ');?></strong></td>
                        </tr>
                    </tfoot>
                </table>
              
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#form-checkout").validate({
            rules: {
                fullname: "required",
                email: {
                    required: true,
                    email: true
                },
                address: "required",
                payment: "required",
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 11
                }
                }
        });
    })
</script>