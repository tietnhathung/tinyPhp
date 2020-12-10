<?php
class Response{

    public function view($viewName , $data = [] , $layout = ""){
        $viewFile = "views/$viewName.php";
        $layoutFile = "views/$layout.php";
        if ( ! file_exists($viewFile) ){
            header($this->_build_http_header_string(404));
            show404Error();
        }
        extract($data);

        ob_start();
        require_once($viewFile);
        $content = ob_get_clean();

        if ( ! file_exists($layoutFile) ){
            $html = $content;
        }else{
            ob_start();
            require_once($layoutFile);
            $html = ob_get_clean();
        }

        header($this->_build_http_header_string(200));
        header("text/html");
        echo $html;
        die;
    }

    public function json( $data = [] ){

        if ( ! is_array($data) ){
            header($this->_build_http_header_string(500));
        }else{
            header($this->_build_http_header_string(200));
        }
        header("Content-Type: application/json");
        echo json_encode($data);
        die;
    }

    private function _build_http_header_string($status_code){
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
    }
}
?>