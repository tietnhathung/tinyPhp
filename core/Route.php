<?php
class Route{
    static private array $get = array();
    static private array $post = array();
    static private array $put = array();
    static private array $delete = array();
    static private array $options = array();
    static private array $patch = array();

    public static function get( $uri , $controller , $name = null ){

        $urlKey  = trim($uri,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$get[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name
        ];
    }

    public static function post( $uri , $controller , $name = null ){

        $urlKey  = trim($uri,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$post[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name
        ];
    }

    public static function put( $uri , $controller , $name = null ){

        $urlKey  = trim($uri,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$put[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name
        ];
    }

    public static function delete( $uri , $controller , $name = null ){

        $urlKey  = trim($uri,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$delete[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name
        ];
    }

    public static function options( $uri , $controller , $name = null ){

        $urlKey  = trim($uri,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$options[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name
        ];
    }

    public static function patch( $uri , $controller , $name = null ){

        $urlKey  = trim($uri,"/");
        $urlRegexKey = str_replace("/","\/", $urlKey);
        $urlRegexKey = str_replace(":w","([\w]+)", $urlRegexKey);
        $urlRegexKey = str_replace(":d","([\d]+)", $urlRegexKey);

        self::$patch[] = [
            "url" => $urlKey,
            "urlRegex" => '/\A'.$urlRegexKey.'\z/',
            "controller" => $controller,
            "name" => $name
        ];
    }

    public static function getRoutes($uri , $method){

        $listRoutes = match ($method) {
            'GET' => self::$get,
            'POST' => self::$post,
            'PUT' => self::$put,
            'DELETE' => self::$delete,
            'OPTIONS' => self::$options,
            'PATCH' => self::$patch
        };


        foreach ($listRoutes as $route){
            if (preg_match($route["urlRegex"], $uri ,$parameters)){
                unset($parameters[0]);
                $route["parameters"] = $parameters;
                return $route;
            }
        }
        return false;
    }

}