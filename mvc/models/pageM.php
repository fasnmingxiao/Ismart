<?php 
class pageM extends DB{
    function add_page($title,$slug,$date){
        $qr= "INSERT INTO `tbl_pages` VALUES(null,'$title','$slug','$date')";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function get_page($s='',$n=''){
        $qr= "SELECT * FROM `tbl_pages` ORDER BY id ASC";
        if ($s != '' && $n != '') {
            $qr .=  ' LIMIT ' . $s . ',' . $n . '';
        } 
        $rows=$this->db_query($qr);
        return json_encode($rows);
    }
    function get_page_by_id($id){
        $qr = "SELECT * FROM `tbl_pages` WHERE `id` = '$id'";
        $rows = $this->db_fetch_row($qr);
        return json_encode($rows);
    }
    function update_page($title,$slug,$date,$id){
        $qr = "UPDATE `tbl_pages` SET `page_title`='$title', `page_link`='$slug',`create_at`= '$date' WHERE `id`= $id";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function del_page_by_id($id){
        $qr= "DELETE FROM `tbl_pages` WHERE `id`=$id";
        $this->db_query($qr,false);
        return json_encode(mysqli_affected_rows($this->con));
    }
}
?>