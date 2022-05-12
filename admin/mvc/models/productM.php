<?php
class productM extends DB
{
    public function add_product($product_title,$product_code, $product_desc, $product_content, $product_thumb,$list_img, $status, $create_at, $creator, $price,$discount, $qty,$cat)
    {
        $qr = "INSERT INTO `tbl_products` VALUES(null,'$product_code','$product_title','$product_desc','$product_content','$product_thumb','$list_img',$status,$cat,'$create_at','$creator',$price,$discount,$qty,'')";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function get_list_cat($a = '', $s = '', $n = '')
    {
        $qr = "SELECT * FROM `tbl_category`";
        if ($a != '') {
            $qr .= 'WHERE Name LIKE "%' . str_replace(' ', '%', $a) . '%"';
        }
        $qr .= 'ORDER BY cat_id ASC ';
        if ($s != '' && $n != '') {
            $qr .=  ' LIMIT ' . $s . ',' . $n . '';
        }
        $rows = $this->db_query($qr);
        return json_encode($rows);
    }


    public function get_cat_dropdown($id = '')
    {
        if ($id != '') {
            $qr = "SELECT * FROM `tbl_category` WHERE `ParentCatID` = '$id'";
        } else {
            $qr = "SELECT * FROM `tbl_category` WHERE `ParentCatID`= '0'";
        }
        $rows = $this->db_query($qr);
        return json_encode($rows);
    }
    public function add_cat($name, $parentid, $creator, $time)
    {
        $qr = "INSERT INTO `tbl_category` VALUES(null,'$parentid','$name','$creator','$time')";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function get_cat_by_id($id)
    {
        $qr = "SELECT * FROM `tbl_category` WHERE `cat_id` = '$id'";
        $rows = $this->db_fetch_row($qr);
        return json_encode($rows);
    }
    public function update_cat($id, $title, $sub_cat)
    {
        $qr = "UPDATE `tbl_category` SET `ParentCatID`='$sub_cat', `Name`='$title' WHERE `cat_id`= '$id'";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function del_cat_by_id($id){
        $qr= "DELETE FROM `tbl_category` WHERE `cat_id`='$id'";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function get_list_product($a = '', $s = '', $n = '')
    {
        $qr= " SELECT `tbl_products`.*,`tbl_category`.`Name` FROM `tbl_products` INNER JOIN `tbl_category` ON `tbl_products`.`category`=`tbl_category`.`cat_id`";
        if($a != ''){
            $qr .= 'WHERE Name product_title "%' . str_replace(' ', '%', $a) . '%"';
        }
        $qr .= 'ORDER BY id ASC ';
        if ($s != '' && $n != '') {
            $qr .=  ' LIMIT ' . $s . ',' . $n . '';
        } 
        $rows= $this->db_query($qr);
        return json_encode($rows);
    }
    public function get_list_product_by_status($id='' ,$a = '', $s = '', $n = ''){
        if(!empty($id)){
            $qr= "SELECT `tbl_products`.*,`tbl_category`.`Name` FROM `tbl_products` INNER JOIN `tbl_category` ON `tbl_products`.`category`=`tbl_category`.`cat_id` WHERE `tbl_products`.`status`= '$id'";
        }else{
            $qr= "SELECT `tbl_products`.*,`tbl_category`.`Name` FROM `tbl_products` INNER JOIN `tbl_category` ON `tbl_products`.`category`=`tbl_category`.`cat_id`";
        }
        if($a != ''){
            $qr .= 'AND `product_title` LIKE  "%' . str_replace(' ', '%', $a) . '%"';
        }
        $qr .= 'ORDER BY id ASC ';
        if ($s != '' && $n != '') {
            $qr .=  ' LIMIT ' . $s . ',' . $n . '';
        } 
        $rows= $this->db_query($qr);
        return json_encode($rows);
    }
    public function del_product_by_id($id)
    {
        $qr = "DELETE FROM `tbl_products` WHERE `id` = '$id'";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);
    }
    public function get_product_by_id($id)
    {
        $qr = "SELECT * FROM `tbl_products` WHERE `id` = '$id'";
        $rows = $this->db_fetch_row($qr);
        return json_encode($rows);
    }
    public function update_product($product_title,$product_code, $product_desc, $product_content, $product_thumb, $status, $create_at, $creator, $price, $qty,$cat,$discount,$list_img,$id )
    {
        $qr = "UPDATE `tbl_products` SET `product_title`='$product_title',`code`='$product_code',`product_desc`='$product_desc',`product_content`='$product_content',product_thumb	='$product_thumb',`status`=$status,`category`=$cat,`create_at`='$create_at',`creator`='$creator',`price`=$price,`qty`=$qty,`discount`=$discount,`image_list`='$list_img' WHERE `id`=$id";
        $result = false;
        if ($this->db_query($qr, false)) {
            $result = true;
        }
        return json_encode($result);

    }

}
