<?php
class ViewEngine{
    private $routes ;

    public function __construct(){
        $this->routes = new ViewRoute();
    }

    public function getView(string $fileName){
        $fileName = trim($fileName , "/");

        $routeFile = $this->routes->getViewFile($fileName);
       
        if ($routeFile != false) {
            return $routeFile["path"];
        }else{
            return $this->renderFile($fileName);
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
            "path" => $newPathFile
        ];

        $this->routes->setViewFile($fileName , $infoFile);

        return $newPathFile;
    }
}