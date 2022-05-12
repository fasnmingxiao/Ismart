<?php 
define('BASE_URL', 'http://localhost/Ismart/admin');
ob_start();
session_start();
require_once "./mvc/bridge.php";
$myApp = new App();
?>