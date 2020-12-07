<?php
class Response{

    public function View($viewName , $data = [] , $layout = ""){
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
            return $content;
        }else{
            ob_start();
            require_once($layoutFile);
            $contentWidthLayout = ob_get_clean();
            return $contentWidthLayout;
        }
    }

}
?>