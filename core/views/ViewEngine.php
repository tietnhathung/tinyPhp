<?php
class ViewEngine{
    private $routes ;

    public function __construct(){
        $this->routes = new ViewRoute();
    }

    public function getView(string $fileName){
       
        $fileName = trim($fileName , "/");

        $originPathFile = "views/$fileName.tiny.xml";

        if ( ! file_exists($originPathFile) ){
            return false;
        }

        $routeFile = $this->routes->getViewFile($originPathFile);
       
        if ( $this->fileNeedReder($originPathFile , $routeFile) ) {
            return $this->renderFile($originPathFile);
        }else{
            return $routeFile["path"];
        }
    }

    private function fileNeedReder($pathFile , $routeFile){
        $mode = config("debug");
        if ($routeFile != false ) {
            $timeChange = filemtime ( $pathFile );
            if ( $mode && $routeFile["timechange"] !=  $timeChange) {
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    private function renderFile($originPathFile){

        $fileContent = file_get_contents($originPathFile, true);

        preg_all_engine($fileContent);

        $routeFile = $this->routes->getViewFile($originPathFile);
        
        if ($routeFile == false ) {
            $file = random_unique();
            $pathFile = "core/cache/views/templates/$file.php";
        }else{
            $pathFile = $routeFile["path"];
        }
        
        $isFilePutSusset = file_put_contents ( $pathFile , $fileContent ) ;
        if( !$isFilePutSusset ){
            return false;
        }
        $fileInfo = [
            "path" => $pathFile,
            "timechange" => filemtime ( $originPathFile ),
        ];
        $this->routes->setViewFile($originPathFile , $fileInfo);

        return $pathFile;
    }
}