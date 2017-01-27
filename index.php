<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */
include "vendor/autoload.php";

$process = new \Sagi\Process\OpenProcess(__FILE__, $argc, $argv);

$process->addProcess('test', function () {
    echo 'test method called';
});


$process->addProcess('do', function () {
    $fork = new \Sagi\Process\ForkProcess();

    $chield = new \Sagi\Process\Process(function () {
        echo "called child";
    });

    $parent = new \Sagi\Process\Process(function () {
        echo "called parent";
    });

    $fork->setChildProcess($chield)
        ->setParentProcess($parent);

    $fork->run();

    echo "called do";
});

$process->run();

$process->runProcess('do');

echo $process->getResult('do');
