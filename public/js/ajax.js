// load product by category 
function load_blog(page){
    $.post("http://localhost/Ismart/ajax/load_blog",{page:page}, function(data){
        $(".main-content").html(data);
     });
}