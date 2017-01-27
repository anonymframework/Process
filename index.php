<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */
include "vendor/autoload.php";

$childProcess = new \Sagi\Process\Process(function ($name){
   echo 'hello i am '. $name. " and i am in child process";
});

$parentProcess = new \Sagi\Process\Process(function (){
   echo "hello i am parent process";
});

$fork = new \Sagi\Process\ForkProcess($parentProcess, $childProcess);

$fork->start();

$fork->setChildParameters(array(
    'name' => 'test'
));

$fork->run();