<?php
class Request{

    private $controller = "defaultController";
    private $method  = "index";

    public function __construct(){
        $this->getSystemParrams();

    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function post($name){
        return $_POST[$name] ?? null;
    }
    public function get($name){
        return $_GET[$name] ?? null;
    }

    private function getSystemParrams(){
        if ( $this->get("controller") != null ){
            $this->controller = $this->get("controller")."Controller";
        }
        if ( $this->get("method") != null ){
            $this->method = $this->get("method");
        }
    }
}