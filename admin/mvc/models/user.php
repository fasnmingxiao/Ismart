<?php


class user extends DB {
    public function checkuser($un,$pw){
        $qr= "SELECT * FROM `tbl_users` WHERE `username`= '". $un . "' AND `password`= '". $pw ."'";
        $rows= mysqli_num_rows($this->db_query($qr,false));
        $result= false;
        if($rows>0){
            $result = true;
        }
        return json_encode($result);
    }
    public function get_fullname($un){
        $qr="SELECT fullname FROM `tbl_users` WHERE username='$un'";
        $row=$this->db_fetch_row($qr);
        return $row;
    }
    public function insert_user($fullname,$username,$password,$email,$phonenb,$token){
        $qr="INSERT INTO `tbl_users` VALUES(null,'$fullname','$username','$password','$email','$phonenb', DEFAULT , '$token')";
        $result=false;
        if($this->db_query($qr,false)){
            $result=true;
        }
        return json_encode($result);
    }
    public function checkUsername($un){
        $qr="SELECT * FROM `tbl_users` WHERE username='$un'";
        $row=(mysqli_num_rows(mysqli_query($this->con,$qr)));
        $kq=false;
        if($row>0){
            $kq=true;
        }
        return json_encode($kq);
    }
    public function active_user($token){
        $qr= "UPDATE `tbl_users` SET verify='1' WHERE token='$token' AND verify= '0'";
        mysqli_query($this->con,$qr);
        return mysqli_affected_rows($this->con);
    }
    public function check_email_username($email,$username){
        $qr= "SELECT * FROM `tbl_users` WHERE email='$email' AND username='$username'";
        $check=mysqli_num_rows($this->db_query($qr,false));
        if ($check>0)
            return true;
        return false;        
    }
    public function update_rs_token($token,$email, $un){
        $qr="UPDATE `tbl_users` SET resertpw='$token' WHERE username='$un' AND email='$email'";
        mysqli_query($this->con,$qr);
        return mysqli_affected_rows($this->con);
    }
    public function update_account_admin($un,$fn,$e,$p){
        $qr="UPDATE `tbl_users` SET fullname='$fn', email='$e', phone='$p' WHERE username='$un'";
        mysqli_query($this->con,$qr);
        return mysqli_affected_rows($this->con);
    }
    public function admin_by_un($un){
        $qr="SELECT * FROM `tbl_users` WHERE username= '$un'";
        $row= $this->db_fetch_row($qr);
        return json_encode($row);
    }
    public function get_password($un){
        $qr="SELECT password FROM `tbl_users` WHERE username='$un'";
        $row=$this->db_fetch_row($qr);
        return json_encode($row);
    }
    public function change_pass($un,$pass,$pass_new){
        $qr="UPDATE `tbl_users` SET `password`='$pass_new' WHERE `username`='$un' AND password= '$pass'";
        mysqli_query($this->con,$qr);
        return mysqli_affected_rows($this->con);
    }
}

?>