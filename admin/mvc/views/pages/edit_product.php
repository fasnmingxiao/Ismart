<?php 
$cat= $data['cat'] ;
$item= $data['product'];
$list_img=json_decode($item['image_list']);
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
            <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
               
                    <form id="my-form" action="" method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?= $item['product_title']?>" data-id="<?=$item['id']?>" required>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?= $item['code']?>" required>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?= $item['price']?>" required>
                        <label for="price">Giảm giá(%)</label>
                        <input type="number" min="1" max="99" name="discount" id="discount" value="<?=$item['discount']?>" required>
                        <label for="product_desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="product_desc" required><?= $item['product_desc']?></textarea>
                        <label for="product_content">Chi tiết</label>
                        <textarea name="product_content" id="product_content" class="ckeditor" required><?=$item['product_content']?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" >
                            <input name="file_old" type="hidden" value="<?= $item['product_thumb']?>">
                            <input type="button" name="btn-upload-thumb" value="Kiểm tra" id="btn-upload-thumb">
                            <img  class="show-img" src="<?=site_url("/public/images/".$item['product_thumb']."")?>" alt="">
                        </div>
                        <label>Ảnh chi tiết bổ sung(* Hãy chọn lại toàn bộ ảnh bổ sung nếu bạn muốn sửa mục này )</label>
                        <div id="image_list">
                            <!-- <input type="file" name="image" id="image_list" multiple="multiple" /> -->
                            <input type="file" id="foo" name="file1" class="img_list" multiple="multiple" accept=".jpg, .png, .gif" data-old='<?= $item['image_list']?>'/>
                            <div class="show-list-img">
                                <?php
                                foreach($list_img as $sub_img){
                                    echo "<img src='".site_url("/public/images/$sub_img")."' class='show_img' alt=''>";
                                }
                                ?>
                            </div>
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <select name="category" id="category-dropdown" required>
                            <option value="">-- Select Category --</option>
                        <?php foreach($cat as $value){ ?>
                        <option value="<?=$value['cat_id']?>"><?= $value['Name'] ?></option>
                        <?php } ?>  
                        
                        </select>
                        <label>Sub Category</label>
                        <select name="sub-category" id="sub-category-dropdown">
                            <option value="">-- Select Sub Category --</option>
                        </select>
                        <label>Trạng thái</label>
                        <select name="status" id="status" required>
                            <option value="0">-- Chọn trạng thái --</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Đã đăng</option>  
                        </select>
                        <label for="qty">Số lượng</label>
                        <input type="text"name="qty" id="qty_product" value="<?= $item['qty']?>" required>
                        <button type="submit" name="btn_edit_product" id="btn-edit-product">Cập nhật</button>
                        <div class="msg"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#my-form").validate({
        rules: {
            product_name: "required",
            product_code: "required",
            price: "required",
            discount: "required",
            product_desc: "required",
            status: "required",
            qty: "required",
        },
        messages: {
            product_name: "Không được để trống tên sản phẩm",
            product_code: "Không được để trống mã sản phẩm",
            price: "Không được để trống giá sản phẩm",
            discount: "Không được để trống giảm giá",
            product_desc: "KhÔng được để trống chi tiết sản phẩm",
            status: "Không được để trống status",
            qty: "Nhập số lượng"
        },
        submitHandler: function (form) {
            var id= $("#product-name").data("id");
			var name = $("#product-name").val();
            var code = $("#product-code").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var desc = $("#product_desc").val();
            var content = CKEDITOR.instances.product_content.getData();
            var img = '';
                    if($("#upload-thumb").val() == '')
                    {
                        img= $("input[name=file_old]").val(); 
                    }else{
                        img=$("#upload-thumb")[0].files[0].name;
                    }
            var list_img = [];
                    if($(".img_list").val() == '')
                    {
                        list_img = $(".img_list").data("old");
                    }else{
                    for (var i = 0; i < $("input[name=file1]").get(0).files.length; ++i) 
                        {
                        list_img.push($("input[name=file1]").get(0).files[i].name);
                        }
                    }
            var sub_thumb= JSON.stringify(list_img);
            var cat = 0;
            if($("#category-dropdown").val() != '' ){
                if($("#sub-category-dropdown").val() != ''){
                    var cat = $("#sub-category-dropdown").val();
                }else{
                    var cat = $("#category-dropdown").val() ;
                }
            }
            var stt= $("#status").val();
            var qty= $("#qty_product").val();
            $.ajax({
             url:"http://localhost/Ismart/admin/ajax/update_product",
             method:"POST",
            data:{id:id,name:name,code:code,price:price,discount:discount,desc:desc,content:content,img:img,list_img:sub_thumb,cat:cat,stt:stt,qty:qty},
             dataType:"JSON",
             success:function(data)
            {
                 console.log(data);
                $(".msg").html(data);
            } 
                })
		}
    });
})
</script>