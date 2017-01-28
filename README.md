[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1fdd2db4-11a7-4ed4-ad6f-5db9f42c74a6/big.png)](https://insight.sensiolabs.com/projects/1fdd2db4-11a7-4ed4-ad6f-5db9f42c74a6)
##OpenProcess

```php 
$process = new \Sagi\Process\OpenProcess(__FILE__);

$process->addProcess('do', function (){
    echo 'do something';
});

$process->run(); // handles requests

$exec = $process->execProcess('do');
// do something while `do` process is running

$exec->getResult(); // you may see result

```

##ForkProcess

`Works only in CGI mode`

```php 


$child = new \Sagi\Process\Process(function (){
    echo 'child process';
});

$parent = new \Sagi\Process\Process(function (){
   echo 'parent process';
});

$fork = new \Sagi\Process\ForkProcess($parent, $child);

$fork->run();

```
