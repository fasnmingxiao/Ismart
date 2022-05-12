    <?php 
class product extends controller{
    public $product;
    function __construct()
    {
        $this->product= $this->model("productM");
    }
    function index(){
        $category= json_decode($this->product->get_cat_dropdown(),true); 
        $this->view("layout-all",['page'=>'add_product','cat'=>$category]);
    }
    function add_product(){
        $category= json_decode($this->product->get_cat_dropdown(),true); 
        $error_form= array();
        if(isset($_POST['btn-add-product'])){
            if(empty($_POST['product_name'])){
                $error_form['product_name']= "Không được để trống tên sản phẩm";
            }else{
                $product_title= $_POST['product_name'];
            }
            if(empty($_POST['product_code'])){
                $error_form['product_code']="Không được để trống mã sản phẩm";
            }else{
                $product_code= $_POST['product_code'];
            }
            if(empty($_POST['price'])){
                $error_form['price']="Không được để trống giá sản phẩm";
            }else{
                $price= $_POST['price'];
            }
            if(empty($_POST['product_desc'])){
                $error_form['product_desc']="Không được để trống mô tả ";
            }else{
                $product_desc= $_POST['product_desc'];
            }
            if(empty($_POST['product_content'])){
                $error_form['product_content']="KhÔng được để trống chi tiết sản phẩm";
            }else{
                $product_content= $_POST['product_content'];
            }
            if(isset($_FILES['file'])){
                if ($_FILES["file"]['error'] != 0){
                     $error_form['file']= "Ban phai upload hinh anh";
                    }else{
                        $target_dir= "/public/images/";
                        $filename=  pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                        $imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                        $target_file= $target_dir . $filename.'-'.time().'.' . $imageFileType;
                        // Cỡ lớn nhất được upload (bytes)
                        $maxfilesize   = 2000000;
                        if (file_exists($target_file))
                        {
                            $error_form['file']= "Tên file đã tồn tại trên server, không được ghi đè";
                        }
                        // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                        if ($_FILES["file"]["size"] > $maxfilesize)
                        {
                            $error_form['file']= "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
                        }
            }
            
            }
            if(!empty($_POST['category'])){
                if(!empty($_POST['sub-category'])){
                    $sub_cat= $_POST['sub-category'];
                }else{
                    $sub_cat= $_POST['category'];
                }
            }
            else{
                $sub_cat= '0';
            }
           if(empty($_POST['status'])){
            $error_form['status']='Không được để trống status';
           }else{
            $status= $_POST['status'];
           }
           if(empty($_POST['qty'])){
               $error_form['qty']='Nhập số lượng';
           }else{
               $qty=$_POST['qty'];
           }
           show_array($_FILES); 
           dd(1);
           if(!empty($error_form)){
            $this->view("layout-all",['page'=>'add_product','error'=>$error_form,'cat'=>$category]);
           }else{
            $date = date('Y-m-d H:i:s');
            $a=$this->product->add_product($product_title,$product_code, $product_desc,$product_content,$target_file,$status,$date,$_SESSION['user_login'],$price,$qty,$sub_cat);
            $this->view("layout-all",['page'=>'add_product','cat'=>$category,'msg'=> $a]);     
           }
        }
    }
    function list_cat(){
       $this->view("layout-all",['page'=>'list_cat']);
    }
    function add_category(){
 
        $category= json_decode($this->product->get_cat_dropdown(),true); 
          $error_form= array();
        if(isset($_POST['btn_add_cat'])){
            if(!empty($_POST['title'])){
                $cat_title= $_POST['title'];
            }
            else{
                $error_form['title']="Không được để trống tên danh mục";
            }
            if(!empty($_POST['category'])){
                if(!empty($_POST['sub-category'])){
                    $sub_cat= $_POST['sub-category'];
                }else{
                    $sub_cat= $_POST['category'];
                }
            }
            else{
                $sub_cat= '0';
            }
            if(!empty($error_form)){
                $this->view("layout-all",['page'=>'add_cat','cat'=>$category,'error'=>$error_form]);
            }else{
                $date = date('Y-m-d H:i:s');
                $creator= $_SESSION['user_login'];
                $a=$this->product->add_cat($cat_title,$sub_cat,$creator,$date);           
                $this->view("layout-all",['page'=>'add_cat','cat'=>$category,'msg'=> $a]);
            }
        }
        else{
            
            $this->view("layout-all",['page'=>'add_cat','cat'=>$category]);
        }
      
    }
    function edit_cat($a=''){
        $data= json_decode($this->product->get_cat_by_id($a),true);
        $category= json_decode($this->product->get_cat_dropdown(),true); 
        $error_form= array();
        if(isset($_POST['btn_update_cat'])){
            if(!empty($_POST['title'])){
                $cat_title= $_POST['title'];
            }
            else{
                $error_form['title']="Không được để trống tên danh mục";
            }
            if(!empty($_POST['category'])){
                if(!empty($_POST['sub-category'])){
                    $sub_cat= $_POST['sub-category'];
                }else{
                    $sub_cat= $_POST['category'];
                }
            }
            else{
                $sub_cat= '0';
            }
          
            if(!empty($error_form)){
                $this->view("layout-all",['page'=>'edit_cat','drop'=>$category,'cat'=>$data,'error'=>$error_form]);
            }else{
                $a=$this->product->update_cat($a,$cat_title,$sub_cat);
                $this->view("layout-all",['page'=>'edit_cat','cat'=>$data,'drop'=>$category,'msg'=> $a]);
            }
        }
        else{
            $this->view("layout-all",['page'=>'edit_cat','cat'=>$data,'drop'=>$category]);
        }
       
    }
    function del_cat($a=''){
        $rt=$this->product->del_cat_by_id($a);
        $this->view("layout-all",['page'=>'list_cat','msg'=>$rt]);
    }
    function list(){
            $limit=1;
            $this->view("layout-all",['page'=>'list_product','limit'=>$limit]); 
        
    }
    function edit_product($a=''){
        $data= json_decode($this->product->get_product_by_id($a),true);
        $category= json_decode($this->product->get_cat_dropdown(),true); 
        // $error_form= array();
        // if(isset($_POST['btn_edit_product'])){
          
        //     if(empty($_POST['product_name'])){
        //         $error_form['product_name']= "Không được để trống tên sản phẩm";
        //     }else{
        //         $product_title= $_POST['product_name'];
        //     }
        //     if(empty($_POST['product_code'])){
        //         $error_form['product_code']="Không được để trống mã sản phẩm";
        //     }else{
        //         $product_code= $_POST['product_code'];
        //     }
        //     if(empty($_POST['price'])){
        //         $error_form['price']="Không được để trống giá sản phẩm";
        //     }else{
        //         $price= $_POST['price'];
        //     }
        //     if(empty($_POST['product_desc'])){
        //         $error_form['product_desc']="Không được để trống mô tả ";
        //     }else{
        //         $product_desc= $_POST['product_desc'];
        //     }
        //     if(empty($_POST['product_content'])){
        //         $error_form['product_content']="KhÔng được để trống chi tiết sản phẩm";
        //     }else{
        //         $product_content= $_POST['product_content'];
        //     }
        //     if($_FILES['file']['name'] != ''){
        //         if ($_FILES["file"]['error'] != 0){
        //              $error_form['file']= "Ban phai upload hinh anh";
        //             }else{
        //                 $target_dir= "/public/images/";
        //                 $filename=  pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        //                 $imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
        //                 $target_file= $target_dir . $filename.'-'.time().'.' . $imageFileType;
        //                 // Cỡ lớn nhất được upload (bytes)
        //                 $maxfilesize   = 2000000;
        //                 if (file_exists($target_file))
        //                 {
        //                     $error_form['file']= "Tên file đã tồn tại trên server, không được ghi đè";
        //                 }
        //                 // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
        //                 if ($_FILES["file"]["size"] > $maxfilesize)
        //                 {
        //                     $error_form['file']= "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
        //                 }
        //     }
        //     }else{
        //         $target_file=$_POST['file_old'];
        //     }
        //     if(!empty($_POST['category'])){
        //         if(!empty($_POST['sub-category'])){
        //             $sub_cat= $_POST['sub-category'];
        //         }else{
        //             $sub_cat= $_POST['category'];
        //         }
        //     }
        //     else{
        //         $error_form['cat']= 'Không đượcc để trống danh mục sản phẩm';
        //     }
            
        //    if(empty($_POST['status'])){
        //     $error_form['status']='Không được để trống status';
        //    }else{
        //     $status= $_POST['status'];
        //    }
        //    if(empty($_POST['qty'])){
        //        $error_form['qty']='Nhập số lượng';
        //    }else{
        //        $qty=$_POST['qty'];
        //    }

        //     if(!empty($error_form)){
        //         $this->view("layout-all",['page'=>'edit_product','cat'=>$category,'product'=>$data,'error'=>$error_form]);
        //     }else{
            
        //         $date = date('Y-m-d H:i:s');
        //         $creator= $_SESSION['user_login'];
        //         $mess=$this->product->update_product($product_title,$product_code,$product_desc,$product_content,$target_file,$status,$date,$creator,$price,$qty,$sub_cat,$a);
        //         $this->view("layout-all",['page'=>'edit_product','cat'=>$category,'product'=>$data,'msg'=> $mess]);
        //     }
        // }
        // else{
        //     $this->view("layout-all",['page'=>'edit_product','cat'=>$category,'product'=>$data]);
        // }
        $this->view("layout-all",['page'=>'edit_product','cat'=>$category,'product'=>$data]);
    }
    function del_product($a=''){
        $rt=$this->product->del_product_by_id($a);
        $limit=1;
            $this->view("layout-all",['page'=>'list_product','limit'=>$limit,'msg'=>$rt]); 
    }
}
?>