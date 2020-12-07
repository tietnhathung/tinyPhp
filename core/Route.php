<?php
class Route{
    static private array $routes;

    public static function add( $url , $controller , $name = null , $namespace = null){

        $urlKey  = trim($url,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$routes[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name,
            "namespace" => $namespace
        ];
    }

    public static function getRoutes($url){

        $listRoutes = self::$routes;

        foreach ($listRoutes as $route){
            if (preg_match($route["urlRegex"], $url ,$parameters)){
                unset($parameters[0]);
                $route["parameters"] = $parameters;
                return $route;
            }
        }
        false;

    }
}