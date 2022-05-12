<?php 
class slider extends controller{
    public $slider;
    function __construct()
    {
        $this->slider=$this->model("sliderM");
    }
    function index(){
        $this->view("layout-all",['page'=>'list_slider']);
    }
    function add(){
        $error_form= array();
        if(isset($_POST['btn-submit'])){
            if(empty($_POST['title'])){
                $error_form['title']= "Không được để trống tên sản phẩm";
            }else{
                $title= $_POST['title'];
            }
            if(empty($_POST['slug'])){
                $error_form['slug']="Không được để trống mã sản phẩm";
            }else{
                $slug= $_POST['slug'];
            }
            if(empty($_POST['num_order'])){
                $error_form['num_order']="Không được để trống mô tả ";
            }else{
                $num_order= $_POST['num_order'];
            }

            if(isset($_FILES['file']))
            {
                if ($_FILES["file"]['error'] != 0)
                {
                     $error_form['file']= "Ban phai upload hinh anh";
                    }else{
                        $target_dir= "/public/images/";
                        $filename=  pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                        $imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
                        $target_file= $target_dir . $filename.'.' . $imageFileType;
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
           if(empty($_POST['status'])){
            $error_form['status']='Không được để trống status';
           }else{
            $status= $_POST['status'];
           }
           if(!empty($error_form)){
            $this->view("layout-all",['page'=>'add_slider','error'=>$error_form]);
           }else{
            $date = date('Y-m-d H:i:s');
            $a=$this->slider->add_slider($target_file,$slug,$num_order,$status,$_SESSION['user_login'],$date);
            $this->view("layout-all",['page'=>'add_slider','msg'=> $a]);     
           }
        }else{
            $this->view("layout-all",['page'=>'add_slider']);
        }
         
     }
}
?>