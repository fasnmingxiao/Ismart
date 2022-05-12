<?php
 class dealM extends DB{
     public function get_deal(){
         $qr="SELECT * FROM `tbl_deal`";
         $rows= $this->db_query($qr);
        return json_encode($rows);
     }
     public function get_deal_ajax($status='' ,$query= '', $s = '', $n = ''){
        if(!empty($status)){
            $qr= "SELECT `tbl_deal`.* , `tbl_status_order`.`name` FROM `tbl_deal` INNER JOIN `tbl_status_order` ON `tbl_deal`.`status`=`tbl_status_order`.`id_status` WHERE `tbl_deal`.`status`= '$status'";
            if($query != ''){
                $qr .= 'AND `full_name` LIKE  "%' . str_replace(' ', '%', $query) . '%"';
            }
        }else{
            $qr= "SELECT `tbl_deal`.* , `tbl_status_order`.`name` FROM `tbl_deal` INNER JOIN `tbl_status_order` ON `tbl_deal`.`status`=`tbl_status_order`.`id_status`";
            if($query != ''){
                $qr .= 'WHERE `full_name` LIKE  "%' . str_replace(' ', '%', $query) . '%"';
            }
        }
        $qr .= 'ORDER BY id ASC ';
        if ($s != '' && $n != '') {
            $qr .=  ' LIMIT ' . $s . ',' . $n . '';
        } 
        $rows= $this->db_query($qr);
        return json_encode($rows);
    }
    public function get_deal_by_id($id){
        $qr="SELECT * FROM `tbl_deal` WHERE id='$id'";
        $rows = $this->db_fetch_row($qr);
        return json_encode($rows);
    }
    public function get_status_deal(){
        $qr="SELECT * FROM `tbl_status_order`";
         $rows= $this->db_query($qr);
        return json_encode($rows);
    }
    public function get_detail_order_by_id($id_order){
        $qr="SELECT `tbl_detailorder`.*,`tbl_products`.`product_title`, `tbl_products`.`product_thumb` FROM `tbl_detailorder` INNER JOIN `tbl_products` ON `tbl_detailorder`.`id_product` = `tbl_products`.`code` AND `tbl_detailorder`.`id_order`= '$id_order'";
        $rows= $this->db_query($qr);
        return json_encode($rows);
    }
    public function update_status($id_stt,$id){
        $qr= "UPDATE `tbl_deal` SET status= $id_stt WHERE id=$id";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function insert_deal($code,$full_name,$phone,$adresss,$email,$date,$payment,$note)
    {
        $qr="INSERT INTO `tbl_deal`(`code`,`full_name`,`phone`,`adress`,`email`,`date`,`payment`,`note`) VALUE ('$code','$full_name','$phone','$adresss','$email','$date',$payment,'$note')";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function insert_detail_deal($id_order,$id_product,$qty,$price,$total_price){
        $qr="INSERT INTO `tbl_detailorder`(id_order,id_product,qty,price,total_price) VALUE ('$id_order','$id_product',$qty,$price,$total_price)";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function max_id(){
        $qr= "SELECT MAX(id) FROM `tbl_deal`";
        $rows = $this->db_fetch_row($qr);
        return $rows;
    }
 }
?>