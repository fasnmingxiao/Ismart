<?php
if(isset($data['msg'])){
    if($data['msg']== true){
        $msg= "Success!";
    }else{
        $msg= "Failed!";
    }
}
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="<?= site_url("/product/add_category") ?>" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="wp_search_box">
                        <p>Search</p>
                        <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
                    </div>
                    <div class="clearfix"></div>
                    <div id="dynmic_content" class="table-responsive">
                        <!-- <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead> -->
                        <!-- <tbody> -->
                        <!-- <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""></a>
                                        </div> 
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                </tr> -->

                        <!-- </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Thứ tự</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                </tr>
                            </tfoot> 
                       </table>-->
                        <!-- </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
            <ul class="pagging"> -->
                        </ul>
                    </div>
                    <div class="msg"><?php echo isset($msg)? $msg : false  ?></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            load_data(1);
            $("#search_box").keyup(function() {
                var qr = $('#search_box').val();
                load_data(1, qr);
            });
            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var qr = $('#search_box').val();
                load_data(page, qr);
            });
        });
    </script>