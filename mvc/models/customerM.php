<?php 
    class customerM extends DB{
        public function get_list_all_customer(){
            $qr="SELECT * FROM `tbl_customer`";
            $rows= $this->db_query($qr);
            return json_encode($rows);
        }
        public function get_list_customer_by_qr($a = '', $s = '', $n = ''){
            $qr= "SELECT * FROM `tbl_customer` ";
            if($a != ''){
                $qr .= 'WHERE `full_name` LIKE  "%' . str_replace(' ', '%', $a) . '%"';
            }
            $qr .= 'ORDER BY id ASC ';
            if ($s != '' && $n != '') {
                $qr .=  ' LIMIT ' . $s . ',' . $n . '';
            } 
            $rows= $this->db_query($qr);
            return json_encode($rows);
        }
    }
?>