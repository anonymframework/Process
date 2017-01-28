# Task
Anonym task repository supports multiple task


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
