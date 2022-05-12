<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="<?=site_url("/menu")?>" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <form method="POST" action="" id="form_menu" onsubmit="insert_menu()">
                        <div class="form-group">
                            <label for="title">Tên menu</label>
                            <input type="text" name="title" id="title" required>
                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <label for="url-static">Đường dẫn tĩnh</label>
                            <input type="text" name="url_static" id="url-static" required>
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Parent id</label>
                            <select name="page_slug" id="dropdown_menu">
                                <option value="0">-- Chọn --</option>
                                <?php
                                $parent = $data['parent'];
                                foreach ($parent as $value) {
                                ?>
                                    <option value="<?= $value['menu_id'] ?>"><?= $value['menu_title'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Sub parent id</label>
                            <select name="page_slug" id="dropdown_sub_menu">


                            </select>
                            <p>Danh mục liên kết đến Trang</p>
                        </div>

                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order" required>
                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Lưu danh mục</button>
                            <div class="msg"></div>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <div class="actions">
                        <select name="post_status">
                            <option value="-1">Tác vụ</option>
                            <option value="delete">Xóa vĩnh viễn</option>
                        </select>
                        <button type="submit" onsubmit="insert_menu()" name="sm_block_status" id="sm-block-status">Áp dụng</button>
                    </div>
                    <div class="table-responsive">


                    </div>
                    <div class="msg_table"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#form_menu").validate();
            load_table_menu(1);
            load_dropdown_menu();
            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                load_table_menu(page);
            })
        });
    </script>