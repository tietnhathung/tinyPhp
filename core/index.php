<?php
require 'helpers/Function.php';
require "helpers/Preg.php";
require "Controller.php";
require "Model.php";
require "Route.php";
require "views/ViewRoute.php";
require "views/ViewEngine.php";
require "http/Request.php";
require "http/Response.php";
require "App.php";
define("DEBUG", config("debug" , false));

if (DEBUG){
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    set_error_handler("showError");
}