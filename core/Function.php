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
    die("Code:404 Page not found! :`(");
}