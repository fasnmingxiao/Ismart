<?php 
class checkout extends controller{
    public $page;
    public $deal;
    function __construct()
    {
        $this->page=$this->model("pageM");
        $this->deal=$this->model("dealM");
    }
    function index(){
        $page= json_decode($this->page->get_page(),true);
        if(!isset($_SESSION['ismart']['cart'])){
            redirect_to(''.site_url("").'');
        }else{
            $this->view("layout-all",['page'=>'checkout','list_page'=>$page]);
        }
    }
    function check(){
        if(isset($_POST['order-now'])){
            $fullname=ucwords($_POST['fullname']);
            $email=$_POST['email'];
            $address= $_POST['address'];
            $phone= $_POST['phone'];
            if(isset($_POST['note'])){
                $note= $_POST['note'];
            }else{
                $note= 'No';
            }
            $payment=$_POST['payment'];
            $max_id=$this->deal->max_id();
            $stt= $max_id['MAX(id)']++;
            $code= date("dmY").initials($fullname).$stt;
            $date=  date("Y-m-d H:i:s");
            $list_cart= get_list_buy_cart();
            show_array($list_cart);
            $this->deal->insert_deal($code,$fullname,$phone,$address,$email,$date,$payment,$note);
            foreach($list_cart as $item){
                $this->deal->insert_detail_deal($code,$item['id'],$item['qty'],$item['price'],$item['sub_total']);
            }
            delete_item();
            echo 'ok';
            
        }else{
            redirect_to(''.site_url("").'');
        }
    
    }
    function done(){
        $page= json_decode($this->page->get_page(),true);
        $this->view("layout-all",['page'=>'done','list_page'=>$page]);

    }
}
?>