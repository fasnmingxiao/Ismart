<?php 
$cat= $data['cat'] ;
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
    <?php require "sidebar.php" ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action="" method="POST" enctype="multipart/form-data" id="my-form">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" required>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" required>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" required>
                        <label for="price">Giảm giá(%)</label>
                        <input type="number" min="1" max="99" name="discount" id="discount" required>
                        <label for="product_desc">Mô tả ngắn</label >
                        <textarea name="product_desc" id="product_desc" required></textarea>
                        <label for="product_content">Chi tiết</label>
                        <textarea name="product_content" id="product_content" class="ckeditor" required></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" required>
                         <div id="show-img"></div>
                        </div>
                        <label>Ảnh chi tiết bổ sung</label>
                        <div id="image_list">
                            <!-- <input type="file" name="image" id="image_list" multiple="multiple" /> -->
                            <input type="file" id="foo" name="file1" class="img_list" multiple="multiple" accept=".jpg, .png, .gif" required/>
                            <div class="show-list-img"></div>
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <select name="category" id="category-dropdown" >
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
                        <label>Trạng thái</label>
                        <select name="status" id="status" required>
                            <option value="0">-- Chọn trạng thái --</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Đã đăng</option>  
                        </select>
                        <input type="text"  name="qty" id="qty_product" required>
                        <button type="submit"  name="btn-add-product" id="btn-add-product" > Thêm mới</button>
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
            file: "required",
            file1: "required",
            status: "required",
            qty: "required",
        },
        messages: {
            product_name: "Không được để trống tên sản phẩm",
            product_code: "Không được để trống mã sản phẩm",
            price: "Không được để trống giá sản phẩm",
            discount: "Không được để trống giảm giá",
            product_desc: "KhÔng được để trống chi tiết sản phẩm",
            file: "Ban phai upload hinh anh",
            file1: "Ban phai upload hinh anh",
            status: "Không được để trống status",
            qty: "Nhập số lượng"
        },
        submitHandler: function (form) {
			var name = $("#product-name").val();
            var code = $("#product-code").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var desc = $("#product_desc").val();
            var content = CKEDITOR.instances.product_content.getData();
            var img = $('input[type=file]')[0].files[0].name;
            var list_img = [];
                for (var i = 0; i < $("input[name=file1]").get(0).files.length; ++i) 
                {
                    list_img.push($("input[name=file1]").get(0).files[i].name);
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
            console.log(name,code,price,discount,desc,content,img,sub_thumb,cat,stt,qty);
            $.ajax({
             url:"http://localhost/Ismart/admin/ajax/insert_product",
             method:"POST",
            data:{name:name,code:code,price:price,discount:discount,desc:desc,content:content,img:img,list_img:sub_thumb,cat:cat,stt:stt,qty:qty},
             dataType:"JSON",
             success:function(data){
                 console.log(data);
                $(".msg").html(data);
        }
    })
		}
    });
})
</script>