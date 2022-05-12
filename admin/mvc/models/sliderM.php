<?php 
class sliderM extends DB{
        function get_list_slider(){
            $qr="SELECT * FROM `tbl_slider`";
            $rows= $this->db_query($qr);
            return json_encode($rows);
        }
        function get_list_slider_by_stt($id_stt='',$start='',$limit=''){
            $qr="SELECT `tbl_slider`.*,`tbl_status_slider`.`name` FROM `tbl_slider` INNER JOIN `tbl_status_slider` ON `tbl_slider`.`status`=`tbl_status_slider`.`id` ";
            if($id_stt != 0 ){
                $qr .= "WHERE `tbl_slider`.`status` = $id_stt";
            }
            $qr .= ' ORDER BY id ASC ';
            if ($start != '' && $limit != '') {
                $qr .=  ' LIMIT ' . $start . ',' . $limit . '';
            } 
            $rows= $this->db_query($qr);
            return json_encode($rows);
        }
        function add_slider($image,$link,$num_sli,$status,$creator,$last_update){
            $qr= "INSERT INTO `tbl_slider` (image,link,num_show,status,creator,last_update) VALUES('$image','$link',$num_sli,$status,'$creator','$last_update')";
            $result = false;
            if ($this->db_query($qr, false)) {
                $result = true;
            }
            return json_encode($result);
        }
}
?>