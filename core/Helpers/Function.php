<?php


function config($index = null , $defaultValue = null){
    $filename = 'config.json';
    if (!file_exists (  $filename )){
        return $defaultValue;
    }

    $stringValue = file_get_contents($filename);

    $dataJson = json_decode($stringValue, true);

    if($index == null){
        return $dataJson;
    }else{
        return $dataJson[$index] ?? $defaultValue;
    }
}

function showError( $errno, $errstr, $errfile, $errline){
    if (!(error_reporting() & $errno)) {
        return false;
    }

    // $errstr may need to be escaped:
    $errstr = htmlspecialchars($errstr);

    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);

        case E_USER_WARNING:
            echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
            break;

        case E_USER_NOTICE:
            echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
            break;

        default:
            echo "Unknown error type: [$errno] $errstr<br />\n";
            break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

function show404Error(){
    header("HTTP/1.1 404 Not Found");
    die("Code:404 Page not found! :`(");
}

function check_file_exists($viewFile){
    if ( ! file_exists($viewFile) ){
        header(build_http_header_string(404));
        show404Error();
    }
}
function build_http_header_string($status_code){
    $status = array(
        200 => 'OK',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error'
    );
    return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
}

function random_unique(){
    $n = 20; 
    $result = bin2hex(random_bytes($n)); 
    return $result; 
}