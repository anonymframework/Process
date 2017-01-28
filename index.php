<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */
include "vendor/autoload.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$process = new \Sagi\Process\OpenProcess(__FILE__);

$process->addProcess('do', function (){
    echo 'do something';
});

$process->addProcess('test', function (){
    for($i = 0; $i < 100; $i++){
        echo $i;
    }
});


$process->run();
