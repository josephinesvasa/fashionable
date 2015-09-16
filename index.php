
<?php
require_once 'controllers/usercontroller.php';
require_once 'controllers/accountcontroller.php';
require_once 'controllers/startcontroller.php';
require_once 'controllers/cartcontroller.php';


$requestURI = explode("/", parse_url(rtrim(strtolower($_SERVER["REQUEST_URI"]), "/"), PHP_URL_PATH));

$controller = "startController";
$action = "indexAction";

if(!empty($requestURI[2])){
    $controller=$requestURI[2] ."controller";
}

if(!empty($requestURI[3])){
    $action=$requestURI[3] . "action";
}

if(method_exists($controller, $action)){
    $obj = new $controller;
    $obj->$action();

}

else {
    echo "You have an unvalid URI";
}


