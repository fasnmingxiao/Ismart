<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="wrap clearfix">
        <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail clearfix">
                    <div id="list-menu" class="fl-left">
                        <form method="POST" id="my-form">
                            <label for="title">Tiêu đề</label>
                            <input style="width:100%" type="text" name="title" id="title" required>
                            <label for="title">Slug ( Friendly_url )</label>
                            <input style="width:100%" type="text" name="slug" id="slug" required>
                            <button type="submit" data-id="1" style="margin-bottom:10px;" name="btn-submit" id="btn-submit">Thêm</button>
                        </form>
                    </div>
                    <div>
                            <div id="msg-succ">Thành công!</div>
                            <div id="msg-fail">Thất bại!</div>
                        </div>

                    <div id="category-menu" class="fl-right">
                        <div class="table-responsive">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            load_table_page(1);
            $("#my-form").validate({
                rules: {
                    title: "required",
                    slug: "required"
                },
                messages: {
                    title: "Vui lòng nhập tên trang",
                    slug: "Vui lòng điền đường dẫn trang"
                },
                submitHandler: function(form) {
                    var slug = $("#slug").val();
                    var title = $("#title").val();
                        $.post("http://localhost/Ismart/admin/ajax/add_page", 
                        {
                            slug: slug,
                            title: title
                        }, function(data){
                            if (data = true) 
                            {
                                $("#msg-succ").css("display", "block");
                            } else 
                            {
                                $("#msg-fail").css("display", "block");
                            }
                            load_table_page(1);
                        });
                }
            });

        })
    </script>