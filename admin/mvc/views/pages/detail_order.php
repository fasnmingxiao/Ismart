<?php
$detail = $data['detail'];
?>
<input id="idpri" type="hidden" value="<?= $data['item']['id']?>">
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?= $data['item']['code'] ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?= $data['item']['adress'] . ' / ' . $data['item']['phone'] ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail">Thanh toán tại nhà</span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select id="status" name="status">
                                <?php foreach ($data['status'] as $status) {
                                    if ($status['id_status'] == $data['item']['status']) {
                                ?>
                                        <option selected='selected' value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <input type="button" name="sm_status" id="sm_status" value="Cập nhật đơn hàng">
                            <div id="msg"></div>
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=1;
                            $total_qty=0;
                            $total_price=0;
                            foreach ($detail as $value) {
                                $total_qty += $value['qty'];
                                $total_price += $value['price'];
                                $strat = explode('-', $value['product_thumb']);
                                $ext =  pathinfo($value['product_thumb'], PATHINFO_EXTENSION);
                                $path = $strat['0'] . '.' . $ext;
                            ?>
                            <tr>
                                <td class="thead-text"><?= $count ?></td>
                                <td class="thead-text">
                                    <div class="thumb">
                                        <img src="<?= site_url($path)?>" alt="">
                                    </div>
                                </td>
                                <td class="thead-text"><?=$value['product_title']?></td>
                                <td class="thead-text"><?=current_format($value['price'],'VNĐ')?></td>
                                <td class="thead-text"><?=$value['qty']?></td>
                                <td class="thead-text"><?=current_format($value['total_price'],'VNĐ')?></td>
                            </tr>
                            <?php
                            $count++;
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?= $total_qty?> sản phẩm</span>
                            <span class="total"><?=current_format($total_price,'VNĐ')?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>