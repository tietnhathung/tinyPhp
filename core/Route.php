<?php
class Route{
    static private array $routes;

    public static function add( $url , $controller , $name = null , $namespace = null){
        self::$routes[] = [    
            "url" => trim($url,"/"),
            "controller" => $controller,
            "name" => $name,
            "namespace" => $namespace
        ];
    }

    public static function getRoutes($url){
        $listRoutes = self::$routes;
        $routes = array_column($listRoutes , null , "url");
        if (isset($routes[$url])) {
            return $routes[$url];
        }else{
            return false;
        }
    }
}