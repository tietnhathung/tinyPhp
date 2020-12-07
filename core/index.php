<?php
require 'Function.php';
require "Controller.php";
require "Model.php";
require "Route.php";
require "Http/Request.php";
require "Http/Response.php";
require "App.php";

define("DEBUG", config("debug" , false));

if (DEBUG){
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    set_error_handler("showError");
}