
$(document).ready(function(){
    $("#username").keyup(function(){
        var un= $(this).val();
        $.post("./ajax/checkusername",{username: un}, function(data){
           $(".error").html(data); 
        });
    });

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    }); 

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });
// ajax update account
    $("#btn-update-account").click(function(e){
        e.preventDefault();
        var fn= $("#display-name").val();
        var un= $("#username").val();
        var e= $("#email").val();
        var p= $("#tel").val();
        $.post("./ajax/updateaccount",{fullname: fn , username: un, email: e, tel: p}, function(data){
             $("#update-text").html(data);
            // alert(data); 
         }); 
    });
    // ajax add menu

// ajax change password 
    $("#btn-change-pass").click(function(e){
        e.preventDefault();
        var passold = $("#pass-old").val();
        var passnew = $("#pass-new").val();
        var confirm_p = $("#confirm-pass").val();
        $.post("http://localhost/Ismart/admin/ajax/changepass",{po: passold, pn: passnew, cp: confirm_p}, function(data){
          $(".text-change-pass").html(data);
           
         });
    });
// file image 
        $("input[name=file]").change(function(e) {
        var image_name=$('#upload-thumb').val();
        if (image_name == ''){
            alert("Please Select Image");
            return false;
        }else{
            var extension= $('#upload-thumb').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg'])== -1){
                alert('Invalid Image File');
                $('#upload-thumb').val('');
                return false;
            }   else{
                let fileName = e.target.files[0].name;
                var baseurl= "http://localhost/Ismart/admin/public/images/"
                $("#show-img").html("<img class='show_img' src='"+baseurl+fileName+"'>")

            }    
        }
    }); 
//list image
            $("input[name=file1]").change(function() {
                var names = [];
                for (var i = 0; i < $(this).get(0).files.length; ++i) {
                var ext=  $(this).get(0).files[i].name.split('.').pop().toLowerCase();
                if(jQuery.inArray(ext, ['gif','png','jpg','jpeg'])== -1){
                        alert('Invalid Image File');
                        $('input[name=file1]').val('');
                        return false;
                        }else{
                        names.push($(this).get(0).files[i].name);
                        }
                }
                          $.each(names, function (index, value) {
                              var baseurl= "http://localhost/Ismart/admin/public/images/"
                                $(".show-list-img").append("<img class='show_img' src='"+baseurl+value+"'>")
                          });
                if ($(this).get(0).files.length <1){
                    $(".show-list-img").html("");
                }
            });
// ajax sub category
    $("#category-dropdown").on('change',function(){
        var cat_id= $(this).val();
        $.post("http://localhost/Ismart/admin/ajax/get_sub_cat",{id: cat_id}, function(data){
           $("#sub-category-dropdown").html(data);
        });
    })
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    var id_stt_cur = $("#status").val();
    var idpri=$("#idpri").val();
        $("#sm_status").on("click",function(){
            
            var id_stt = $("#status").val();
            
            if (id_stt_cur != id_stt) {
                $.post("http://localhost/Ismart/admin/ajax/update_status",{id: id_stt,id_od: idpri}, function(data){
                $("#msg").text(data);
                });
            }else {
                $("#msg").text("Cập nhật tình trạng phải khác tình trạng hiện tại"); 
            }
                });
   
    
    
// ajax load data 
});
function format_curency(a) {
    a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}
function load_data(page, query= ''){
    $.ajax({
        url: "http://localhost/Ismart/admin/ajax/load_data",
        method:"POST",
        data:{page:page,query:query},
        success:function(data){
            $('#dynmic_content').html(data);
        }
    });
}
function load_data_product(page,query='',status){
    $.ajax({
        url:"http://localhost/Ismart/admin/ajax/load_data_product",
        method:"POST",
        data:{page:page,query:query,status:status},
        dataType:"JSON",
        success:function(data){
         $('.table-responsive').html(data.output);
        $('.post-status .publish span').text(data.vrf);
        $('.post-status .all span').text(data.all);
        $('.post-status .pending span').text(data.wait);
        }
    })
}
function load_deal(page,query='',status){
    $.ajax({
        url:"http://localhost/Ismart/admin/ajax/load_deal",
        method:"POST",
        data:{page:page,query:query,status:status},
        dataType:"JSON",
        success:function(data){
        $("#tab-deal").html(data.output);
        $('.post-status .all span').text(data.all);
        $('.post-status .pending span').text(data.vrf);
        $('.post-status .publish span').text(data.wait);
        $('.post-status .done span').text(data.done);
        }
    })
}
function load_list_blog(page,query='',status){
    $.ajax({
        url:"http://localhost/Ismart/admin/ajax/load_list_blog",
        method:"POST",
        data:{page:page,query:query,status:status},
        dataType:"JSON",
        success:function(data){
        $(".table-responsive").html(data.output);
        $('.post-status .all span').text(data.all);
        $('.post-status .pending span').text(data.vrf);
        $('.post-status .publish span').text(data.wait);
        }
    })
}
function load_data_customer(page,query=''){
    $.ajax({
        url:"http://localhost/Ismart/admin/ajax/load_customer",
        method:"POST",
        data:{page:page,query:query},
        dataType:"JSON",
        success:function(data){
        $('.table-responsive').html(data.output);
        $('.post-status .all span').text(data.all);
        }
    })
}
function load_data_slider(page,status){
    $.ajax({
        url:"http://localhost/Ismart/admin/ajax/load_list_slider",
        method:"POST",
        data:{page:page,status:status},
        dataType:"JSON",
        success:function(data){

        $('.table-responsive').html(data.output);
        $('.post-status .all span').text(data.all);
        $('.post-status .pending span').text(data.vrf);
        $('.post-status .publish span').text(data.wait);
        }
    })
}
function load_table_menu(page)
{
    $.ajax({
        url: "http://localhost/Ismart/admin/ajax/load_table_menu",
        method:"POST",
        data:{page:page},
        success:function(data){
            $('.table-responsive').html(data);
        }
    });
}
function load_table_page(page)
{
    $.ajax({
        url: "http://localhost/Ismart/admin/ajax/load_menu_page",
        method:"POST",
        data:{page:page},
        success:function(data){
            $('.table-responsive').html(data);
        }
    });
}
function load_dropdown_menu(){
    $("#dropdown_menu").on('change',function(){
        var id= $(this).val();
        $.post("http://localhost/Ismart/admin/ajax/get_sub_menu",{id:id}, function(data){
           $("#dropdown_sub_menu").html(data);
        });
    })
}
function insert_menu(){
    var title= $("#title").val();
    var url= $("#url-static").val();
    var parent_id= $("#dropdown_menu").val();

    if(parent_id != 0){
        if($("#dropdown_sub_menu").val() !=0)
        {
            parent_id = $(this).val();
        }
    }else{
        parent_id=0;
    }
    var num_show= $("#menu-order").val();
    if( title != '' && url != '' && num_show != ''){
        $.post("http://localhost/Ismart/admin/ajax/insert_menu",{title: title, url: url,parent_id:parent_id,num_show:num_show}, function(data){
            $(".msg").html(data);
           });
    }else{
        $(".msg").html("Không được để trống các mục bắt buộc");
    }
}
function load_edit_menu(){
    let x = $(".edit");
    for (let i = 0; i < x.length; i++) {
        x[i].onclick = function() {
            var id = $(this).data("id");
            $.post("http://localhost/Ismart/admin/ajax/load_menu_edit",{id:id}, function(data){
                $("#list-menu").html(data);
                });
        };
    }
}
function load_edit_page(){
    let x = $(".edit");
    for (let i = 0; i < x.length; i++) {
        x[i].onclick = function() {
            var id = $(this).data("id");
            $.post("http://localhost/Ismart/admin/ajax/load_page_edit",{id:id}, function(data){
                $("#list-menu").html(data);
                });
        };
    }
}
function update_page(){
                var id= $("#btn-submit").data("id");
                var slug = $("#slug").val();
                var title = $("#title").val();
                $.post("http://localhost/Ismart/admin/ajax/update_page", 
                        {
                            slug: slug,
                            title: title,
                            id: id
                        }, function(data) 
                        {
                            if (data = true) 
                            {
                                $("#msg-succ").css("display", "block");
                            } 
                            else 
                            {
                                $("#msg-fail").css("display", "block");
                            }
                            load_table_page(1);
                        });
}
function del_page(){
    let x = $(".delete");
    for (let i = 0; i < x.length; i++) {
        x[i].onclick = function() {
            var id = $(this).data("id");
            if(confirm('Bạn có thực sự muốn xóa mục và các mục con của mục này?')){
                $.post("http://localhost/Ismart/admin/ajax/del_page",{id:id}, function(data){
                    $("#msg-succ").css("display", "block");
                    load_table_page(1);
                    });
            } else {
                console.log('No.');
            }
        };
    }
}
function del_menu(){
    let x = $(".delete");
    for (let i = 0; i < x.length; i++) {
        x[i].onclick = function() {
            var id = $(this).data("id");
            if(confirm('Bạn có thực sự muốn xóa mục và các mục con của mục này?')){
                $.post("http://localhost/Ismart/admin/ajax/del_menu",{id:id}, function(data){
                    $(".msg_table").html("Đã xóa thành công "+data+" mục.");
                    load_table_menu(1);
                    });
            } else {
                console.log('No.');
            }
            
        };
    }
}
function insert_post(){
    var title = $("#title").val();
    var desc = CKEDITOR.instances.desc.getData() ;
    var file = $("#upload-thumb")[0].files[0];
    if(file){
        file = file.name;
    }
    if(title == null || desc == null || file == null){
        $("#form-notify").html("<strong style='color:red'>Bạn hãy điền hết các vào các trường còn trống!</strong>")
    }else {
        creator = $("#account").text();
        $.post("http://localhost/Ismart/admin/ajax/insert_post",{title:title,  desc:desc, file:file, creator: creator}, function(data){
            $("#form-notify").html(data);
            });
    }
}
function update_menu(){
    var id= $("#btn-update-menu").data("id");
    var title= $("#title").val();
    var url= $("#url-static").val();
    var parent_id= $("#dropdown_menu").val();
    if(parent_id != 0){
        if($("#dropdown_sub_menu").val() !=0)
        {
            parent_id = $(this).val();
        }
    }else{
        parent_id=0;
    }
    var num_show= $("#menu-order").val();
    if( title != '' && url != '' && num_show != ''){
        $.post("http://localhost/Ismart/admin/ajax/update_menu",{id:id,title: title, url: url,parent_id:parent_id,num_show:num_show}, function(data){
            $(".msg").html(data);
            load_table_menu(1);
           });
    }else{
        $(".msg").html("Không được để trống các mục bắt buộc");
    }
}
// function insert_product(){
//     var name = $("#product-name").val();
//     var code = $("#product-code").val();
//     var price = $("#price").val();
//     var discount = $("#discount").val();
//     var desc = $("#product_desc").val();
//     var content = CKEDITOR.instances.product_content.getData();
//     var img = $('input[type=file]')[0].files[0].name;
//     var list_img = $.map($('.img_list').get(0).files, function(file) {
//         return file.name;
//       });
//       var cat = 0;
//     if($("#category-dropdown").val() != '' ){
//         if($("#sub-category-dropdown").val() != ''){
//             var cat = $("#sub-category-dropdown").val();
//          }else{
//             var cat = $("#category-dropdown").val() ;
//          }
//     }
//     var stt= $("#status").val();
//     var qty= $("#qty_product").val();
//     console.log(name,code,price,discount,desc,content,img,list_img,cat,stt,qty);
    
    

// }