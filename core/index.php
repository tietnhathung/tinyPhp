<?php
require 'Function.php';
require "Controller.php";
require "Model.php";
require "Request.php";

define("DEBUG", config("debug" , false));

if (DEBUG){
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    set_error_handler("showError");
}

if (config("composer" , true) && file_exists("vendor/autoload.php")){
    require "vendor/autoload.php";
}

$request = new Request();

$controllerName = $request->getController();
$method = $request->getMethod();


if ( ! file_exists("controllers/$controllerName.php") ){
    show404Error();
}

require "controllers/$controllerName.php";

$controller = new $controllerName();

if ( ! method_exists($controller , $method ) ){
    show404Error();
}

$controller->{$method}();
