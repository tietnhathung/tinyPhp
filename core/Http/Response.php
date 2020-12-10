<?php
class Response{

    public function view($viewName , $data = [] , $layout = ""){
        $viewFile = "views/$viewName.php";
        $layoutFile = "views/$layout.php";
        $this->_check_file_exists($viewFile);
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

    public function render($fileName,$data){
        $pathFile = "views/$fileName.tiny";
        $this->_check_file_exists($pathFile);

        $fileContent = file_get_contents($pathFile, true);

        preg_match('/<[\s]*foreach[\s]*data[\s]*=[\s]*"([$\w =>]+)"[\s]*>/', $fileContent, $value);

        $inforeach = $value[1] ??"";

        $htmlraw =  preg_replace('/<[\s]*foreach[\s]*data[\s]*=[\s]*"([$\w =>]+)"[\s]*>/', "<?php foreach($inforeach): ?>", $fileContent );

        $html =  preg_replace('/<\/[\s]*foreach[\s]*>/' , "<?php endforeach; ?>", $htmlraw );

        file_put_contents ( "core/cacheView/people.php" , $html ) ;

        $fileContent2 = file_get_contents("core/cacheView/people.php", true);

        require_once ("core/cacheView/people.php");

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

    private function _check_file_exists($viewFile){
        if ( ! file_exists($viewFile) ){
            header($this->_build_http_header_string(404));
            show404Error();
        }
    }

}

?>