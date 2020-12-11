<?php
class ViewEngine{
    private $routes ;

    public function __construct(){
        $this->routes = new ViewRoute();
    }

    public function getView(string $fileName){
       
        $fileName = trim($fileName , "/");

        $routeFile = $this->routes->getViewFile($fileName);
       
        if ( $this->fileNeedReder($fileName , $routeFile) ) {
            return $this->renderFile($fileName);
        }else{
            return $routeFile["path"];
        }
    }

    private function fileNeedReder($fileName , $routeFile){
        $mode = config("debug");
       
        if ($routeFile != false ) {
            $pathFile = "views/$fileName.tiny"; 
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

    private function renderFile($fileName){
        
        $originPathFile = "views/$fileName.tiny";
        
        if ( ! file_exists($originPathFile) ){
            return false;
        }

        $fileContent = file_get_contents($originPathFile, true);

        preg_all_engine($fileContent);

        $routeFile = $this->routes->getViewFile($fileName);
        
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
        $this->routes->setViewFile($fileName , $fileInfo);

        return $pathFile;
    }
}