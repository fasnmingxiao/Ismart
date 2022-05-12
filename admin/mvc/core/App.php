<?php
class App
{
    protected $controller = "login";
    protected $action = "index";
    protected $params = [];
    function __construct()
    {

        // require de dung cac function can thiet
        require_once "./mvc/helper/Common.php";
        require_once "./mvc/helper/email.php";
        require_once "./mvc/helper/pagging.php";
        $arr = $this->UrlProcess();
        // XU LI CONTROLLER
        if (isset($arr[0]) && file_exists("./mvc/controllers/" . $arr[0] . ".php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        }
       require_once "./mvc/controllers/" . $this->controller . ".php";
        // XU LI ACTION
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }
        //XU LI PARAMS
        $this->params = $arr ? array_values($arr) : [];

 
        // chinh la hàm ni chú , hn sẽ gọi đến controller, action mô , còn lại param hn sẽ lấy là đằng sau /controller/action/abc/abcb
        // sau khi hn tach dc /controller/action còn lại abc, abcb hn sẽ cho hết là param của function trong controller
        // cai ni tuong tu vi du 2 
       call_user_func_array([new $this->controller, $this->action], $this->params);
    }
    function UrlProcess()
    {
        if (isset($_GET["url"]) && $_GET['url'] != null) {
            return    explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}
