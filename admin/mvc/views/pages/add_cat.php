<?php
$cat= $data['cat'] ;
$error_form=array();
if(isset($_POST['btn_add_cat'])){
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

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action="<?=site_url("/product/add_category")?>" method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title" id="title">
                        <?php form_error($error_form,'title') ?>
                        <label>Category</label>
                        <select name="category" id="category-dropdown">
                            <option value="">-- Select Category --</option>
                        <?php
                        foreach($cat as $item){
                        ?>
                        <option value="<?=$item['cat_id']?>"><?= $item['Name'] ?></option>
                        <?php
                         }
                        ?>
                        </select>
                        <label>Sub Category</label>
                        <select name="sub-category" id="sub-category-dropdown">
                            <option value="">-- Select Sub Category --</option>
                        </select>
                        <button type="submit" name="btn_add_cat" id="btn_add_cat">Cập nhật</button>
                        <div class="msg"><?php echo isset($msg)? $msg : false  ?></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>