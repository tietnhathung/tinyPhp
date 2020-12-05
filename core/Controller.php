<?php
class Controller{

    public function __construct(){

    }

    protected function View($viewName , $data = [] , $layout = ""){
        $viewFile = "views/$viewName.php";
        $layoutFile = "views/$layout.php";
        if ( ! file_exists($viewFile) ){
            show404Error();
        }
        extract($data);
        ob_start();
        require_once($viewFile);
        $content = ob_get_clean();
        if ( ! file_exists($layoutFile) ){
            echo $content;
        }else{
            require_once($layoutFile);
        }
    }

    private function show404Error(){
        die("Code:404 View not found! :`(");
    }
}