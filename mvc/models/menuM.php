<?php 
class menuM extends DB{
    public function get_menu($s='',$n=''){
        $qr= "SELECT * FROM `tbl_menu` ORDER BY menu_id ASC";
        if ($s != '' && $n != '') {
            $qr .=  ' LIMIT ' . $s . ',' . $n . '';
        } 
        $rows=$this->db_query($qr);
        return json_encode($rows);
    }   
    public function get_menu_show(){
        $qr= "SELECT * FROM `tbl_menu` ORDER BY num_show ASC";
        $rows=$this->db_query($qr);
        return json_encode($rows);
    }
    public function get_parent_url_dropdown(){
        $qr="SELECT * FROM `tbl_menu` WHERE `menu_parent_id`=0 ORDER BY num_show ASC";
        $rows=$this->db_query($qr);
        return json_encode($rows);
    }
    public function get_sub_menu($id){
        $qr="SELECT * FROM `tbl_menu` WHERE menu_parent_id=$id";
        $rows=$this->db_query($qr);
        return json_encode($rows);
    }
    public function insert_menu($menu_title,$menu_url,$menu_parent_id,$num_show){
        $qr="INSERT INTO `tbl_menu`(menu_title,menu_url,menu_parent_id,num_show) VALUES('$menu_title','$menu_url',$menu_parent_id,$num_show)";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function get_menu_by_id($id){
        $qr="SELECT * FROM `tbl_menu` WHERE `menu_id`=$id";
        $rows = $this->db_fetch_row($qr);
        return json_encode($rows);
    }
    public function del_menu_by_id($id){
        $qr= "DELETE FROM `tbl_menu` WHERE `menu_id`=$id OR `menu_parent_id`=$id";
        // $result = false;
        // if ($this->db_query($qr, false)) {
        //     $result = true;
        // }
        $this->db_query($qr,false);
        return json_encode(mysqli_affected_rows($this->con));
    }
}
?>