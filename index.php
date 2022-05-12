<? 123 ?>
<?php 
define('BASE_URL', 'http://localhost/Ismart');
ob_start();

session_start();

require_once "./mvc/bridge.php";
$myApp = new App();
?>