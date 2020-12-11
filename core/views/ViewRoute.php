<?php
class ViewRoute{
    private $routes = array();
    private $fileName = "core/cache/views/Router.json";
    public function __construct(){
        $this->routes = json_decode( file_get_contents($this->fileName) ,true);
        
    }
    public function getViewFile(string $key)
    {
        if (isset($this->routes[$key]) && !empty($this->routes[$key])) {
            return $this->routes[$key];
        }else{
            return false;
        }
    }
    public function setViewFile(string $key , array $value)
    {
        
        $this->routes[$key] = $value;
        file_put_contents( $this->fileName , json_encode( $this->routes ) );
    }

}