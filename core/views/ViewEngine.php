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
        
        $pathFile = "views/$fileName.tiny";
        
        if ( ! file_exists($pathFile) ){
            return false;
        }

        $fileContent = file_get_contents($pathFile, true);

        preg_all_engine($fileContent);

        $file = random_unique();

        $newPathFile = "core/cache/views/templates/$file.php";

        $isFilePutSusset = file_put_contents ( $newPathFile , $fileContent ) ;

        if( !$isFilePutSusset ){
            return false;
        }        

        $infoFile = [
            "path" => $newPathFile,
            "timechange" => filemtime ( $pathFile ),
        ];

        $this->routes->setViewFile($fileName , $infoFile);

        return $newPathFile;
    }
}