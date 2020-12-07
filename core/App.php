<?php
class App{

    public function __construct(){
        if (config("composer" , true) && file_exists("vendor/autoload.php")){
            require "vendor/autoload.php";
        }
    }

    public function run(){

        $url = trim($_SERVER['REQUEST_URI'],"/");

        $route  =  Route::getRoutes($url);

        if ($route == false) {
            show404Error();
        }
        list( $controllerName , $methodName , $namespace ) =  $this->getParramsFromRoute($route);
        
        if ( ! file_exists("controllers/$controllerName.php") ){
            show404Error();
        }
        
        require "controllers/$controllerName.php";
        
        $controller = new $controllerName();
        
        if ( ! method_exists($controller , $methodName ) ){
            show404Error();
        }
        
        $controller->{$methodName}();
    }

    private function getParramsFromRoute($route){
        $dataRoute = explode('::', $route["controller"]?? "");
        return [
            $dataRoute[0]??'',
            $dataRoute[1]??'',
            $route["namespace"]?? "",
        ];
    }
}