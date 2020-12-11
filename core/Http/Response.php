<?php
class Response{

    private $view ;

    function __construct(){
        $this->view = new ViewEngine();
    }

    public function view($viewName , $data = [] , $layout = null){
        $viewFile = $this->view->getView($viewName);
        
        if ($viewFile == false) {
            show404Error();
        }
        
        extract($data);

        ob_start();
        require_once($viewFile);
        $content = ob_get_clean();

        if ( $layout == null ){
            $html = $content;
        }else{
            $layoutFile = $this->view->getView($layout);
            if ($layoutFile == false) {
                show404Error();
            }
            ob_start();
            require_once($layoutFile);
            $html = ob_get_clean();
        }

        header(build_http_header_string(200));
        header("text/html");
        echo $html;
        die;
    }

    public function json( $data = [] ){

        if ( ! is_array($data) ){
            header(build_http_header_string(500));
        }else{
            header(build_http_header_string(200));
        }

        header("Content-Type: application/json");
        echo json_encode($data);
        die;
    }

    public function render($fileName)
    {
        
    }
}
?>