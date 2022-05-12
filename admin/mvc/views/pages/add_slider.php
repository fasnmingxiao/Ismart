<?php 
$error_form=array();
if(isset($_POST['btn-submit'])){
    if(isset($data['error'])){
        $error_form=$data['error'];
    }
    if(isset($data['msg'])){
        if($data['msg']== true){
            $msg= "Success!";
        }else{
            $msg= "Failed!";
        }
    }
}
?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên slider</label>
                        <input type="text" name="title" id="title">
                        <?php form_error($error_form,'title') ?>
                        <label for="title">Link</label>
                        <input type="text" name="slug" id="slug">
                        <?php form_error($error_form,'slug') ?>
                        <label for="title">Thứ tự</label>
                        <input type="number" min="1" max="10" name="num_order" id="num-order">
                        <?php form_error($error_form,'num_order') ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="button" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="show_img" src="">
                        </div>
                        <?php form_error($error_form,'file') ?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Công khai</option>
                            <option value="2">Chờ duyệt</option>
                        </select>
                        <?php form_error($error_form,'status') ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        
                    </form>
                    <div class="msg"><?php echo isset($msg)? $msg : false  ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
                var fileUpload = document.querySelector("#upload-thumb");
                var site_url= "http://localhost/Ismart/admin/public/images/";
                fileUpload.addEventListener("change", (event) => {
                var { files } = event.target; 
                console.log (files[0]);
                $("#show_img").attr("src",site_url + files[0].name);
                })

</script>