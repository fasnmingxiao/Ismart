<?php 
class blogM extends DB{
public function get_all_post(){
    $qr="SELECT * FROM `tbl_blog`";
    $rows= $this->db_query($qr);
    return json_encode($rows);
}
public function get_post_ajax($status='' ,$query= '', $s = '', $n = ''){
    if(!empty($status)){
        $qr= "SELECT * FROM `tbl_blog` WHERE `status`= '$status'";
        if($query != ''){
            $qr .= 'AND `title` LIKE  "%' . str_replace(' ', '%', $query) . '%"';
        }
    }else{
        $qr= "SELECT * FROM `tbl_blog`";
        if($query != ''){
            $qr .= 'WHERE `title` LIKE  "%' . str_replace(' ', '%', $query) . '%"';
        }
    }
    $qr .= 'ORDER BY id ASC ';
    if ($s != '' && $n != '') {
        $qr .=  ' LIMIT ' . $s . ',' . $n . '';
    } 
    $rows= $this->db_query($qr);
    return json_encode($rows);
}
public function insert($title,$img,$time,$desc,$creator){
    $qr="INSERT INTO `tbl_blog` (`title`,`img_thumb`,`last_update`,`content`,`creator`) VALUES('$title','$img','$time','$desc','$creator')";
    $result = false;
    if ($this->db_query($qr, false)) {
        $result = true;
    }
    return json_encode($result);
}
}
