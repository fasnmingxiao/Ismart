<?php

class DB{
        public $con;
        public $severname= "localhost";
        public $username= "root";
        public $password="";
        public $dbname= "ismart";
        function __construct()
        {
            $this->con = mysqli_connect($this->severname, $this->username,$this->password);
            mysqli_select_db($this->con,$this->dbname);
            mysqli_query($this->con,"SET NAMES 'utf-8'");
        }   
          //Thực thi chuổi truy vấn
        function db_query($query_string,$isArray = true){
            $result = mysqli_query($this->con, $query_string);
            if (!$result) {
                $this->db_sql_error('Query Error', $query_string);
            }
            if($isArray == true){
                $arr= array();
                while($row = mysqli_fetch_assoc($result)){
                $arr[]= $row;
             }
             return $arr;
            }else {
                // lay khac array
                return $result;
            }
           
        }
        // lấy 1 dòng trong db
        function db_fetch_row($query_string) {
            $result = array();
            $result = mysqli_fetch_assoc($this->db_query($query_string, false));
            // $result = mysqli_fetch_assoc($mysqli_result);
            // mysqli_free_result($mysqli_result);
            return $result;
        }

        
        function db_sql_error($message, $query_string = "") {

        
            $sqlerror = "<table width='100%' border='1' cellpadding='0' cellspacing='0'>";
            $sqlerror.="<tr><th colspan='2'>{$message}</th></tr>";
            $sqlerror.=($query_string != "") ? "<tr><td nowrap> Query SQL</td><td nowrap>: " . $query_string . "</td></tr>\n" : "";
            $sqlerror.="<tr><td nowrap> Error Number</td><td nowrap>: " . mysqli_errno($this->con) . " " . mysqli_error($this->con) . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> Date</td><td nowrap>: " . date("D, F j, Y H:i:s") . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> IP</td><td>: " . getenv("REMOTE_ADDR") . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> Browser</td><td nowrap>: " . getenv("HTTP_USER_AGENT") . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> Script</td><td nowrap>: " . getenv("REQUEST_URI") . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> Referer</td><td nowrap>: " . getenv("HTTP_REFERER") . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> PHP Version </td><td>: " . PHP_VERSION . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> OS</td><td>: " . PHP_OS . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> Server</td><td>: " . getenv("SERVER_SOFTWARE") . "</td></tr>\n";
            $sqlerror.="<tr><td nowrap> Server Name</td><td>: " . getenv("SERVER_NAME") . "</td></tr>\n";
            $sqlerror.="</table>";
            $msgbox_messages = "<meta http-equiv=\"refresh\" content=\"9999\">\n<table class='smallgrey' cellspacing=1 cellpadding=0>" . $sqlerror . "</table>";
            echo $msgbox_messages;
            exit;
        }
    }
