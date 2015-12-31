<?php

define('APPLICATION_PATH', dirname(__FILE__));

$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");

$application->getDispatcher()->throwException(FALSE);  
$application->getDispatcher()->setErrorHandler("myErrorHandler"); 

$application->bootstrap()->run();

function myErrorHandler($errno, $errstr, $errfile, $errline){
    switch ($errno) {
        case YAF_ERR_NOTFOUND_CONTROLLER:
        case YAF_ERR_NOTFOUND_MODULE:
        case YAF_ERR_NOTFOUND_ACTION:
            header("Not Found");
            break;

        default:
            echo 'errno: '.$errno.'<br>';
            echo 'errstr: '.str_replace(APPLICATION_PATH, '[PATH]', $errstr).'<br>';
            echo 'errfile: '.str_replace(APPLICATION_PATH, '[PATH]', $errfile).'<br>';
            echo 'errline: '.$errline.'<br>';

            break;
    }
    return true;
}
?>
