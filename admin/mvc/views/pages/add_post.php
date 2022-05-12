<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" id="form_insert">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" >
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" >
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="show_img" src="">
                        </div>
                        <button type="button" onclick="insert_post()" name="btn-submit" id="btn-submit">Thêm mới</button>
                        <p id="form-notify"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#form_insert").validate();
        var fileUpload = document.querySelector("#upload-thumb");
                var site_url= "http://localhost/Ismart/admin/public/images/";
                fileUpload.addEventListener("change", (event) => {
                var { files } = event.target; 
                console.log (files[0]);
                $("#show_img").attr("src",site_url + files[0].name);
                });

    })
</script>