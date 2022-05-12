<?php 
class deal extends controller{
    public $deal;
    function __construct()
    {
        $this->deal=$this->model("dealM");
    }
    function index(){
        $this->view("layout-all",['page'=>'list_order']);
    }
    function detail_order($id=''){
        if(empty($id)){
            redirect_to(''.site_url("/errorpage").'');
        }else{
            $item=json_decode($this->deal->get_deal_by_id($id),true);
            $detail=json_decode($this->deal->get_detail_order_by_id($item['code']),true);
            $status=json_decode($this->deal->get_status_deal(),true);
            $this->view("layout-all",['page'=>'detail_order','item'=>$item,'status'=>$status,'detail'=>$detail]);
        }
    }
}
?>