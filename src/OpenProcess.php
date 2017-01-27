<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;

/**
 * Class OpenProcess
 * @package Sagi\Process
 */
class OpenProcess
{

    /**
     * @var array<resource>
     */
    protected $results;

    /**
     * @var string
     */
    protected $scriptPath;

    /**
     * @var array<Process>
     */
    protected $proccesses;

    /**
     * @var int
     */
    protected $argc;

    /**
     * @var array
     */
    protected $argv;

    /**
     * OpenProcess constructor.
     * @param string $path
     * @param int $argc
     * @param array $argv
     */
    public function __construct($path = __FILE__, $argc = 0, $argv = [])
    {
        $this->argc = $argc;
        $this->argv = $argv;

        $this->setScriptPath($path);
    }


    public function run()
    {
        $argc = $this->argc;
        $argv = $this->argv;

        if ($argc > 1) {
            if ($key = array_search("--run", $argv)) {
                $funcKey = $key + 1;
                if (isset($argv[$funcKey])) {
                    $name = trim($argv[$funcKey]);
                    if (isset($this->proccesses[$name])) {
                        $process = $this->proccesses[$name];

                        $process->run([]);

                        return $process->getResult();
                    } else {
                        throw new \BadFunctionCallException(sprintf('%s process not found', $name));
                    }
                } else {
                    throw new \BadFunctionCallException('You must have put a function name after --run');
                }
            }
        }
    }


    /**
     * @param $name
     * @return bool|string
     */
    public function getResult($name){
        if (isset($this->results[$name])) {
            return stream_get_contents($this->results[$name]);
        }

        return false;
    }

    public function runProcess($name)
    {
        if ($this->argc === 1) {
            if (version_compare(PHP_VERSION, '5.4.0', '>')) {
                $php = PHP_BINARY;
            } else {
                $php = 'php';
            }

            $cont = popen(sprintf('%s %s --run %s', $php, $this->getScriptPath(), $name), 'r');

            $this->results[$name] = $cont;
        }

        return $this;
    }

    /**
     * @param string $name
     * @param callable|ProcessInterface $process
     * @return $this
     */
    public function addProcess($name, $process)
    {
        if (!$process instanceof ProcessInterface && is_callable($process)) {
            $process = new Process($process);
        }

        $this->proccesses[$name] = $process;

        return $this;
    }

    /**
     * @return array
     */
    public function getProccesses()
    {
        return $this->proccesses;
    }

    /**
     * @param array $proccesses
     * @return OpenProcess
     */
    public function setProccesses($proccesses)
    {
        $this->proccesses = $proccesses;
        return $this;
    }

    /**
     * @return string
     */
    public function getScriptPath()
    {
        return $this->scriptPath;
    }

    /**
     * @param string $scriptPath
     * @return OpenProcess
     */
    public function setScriptPath($scriptPath)
    {
        $this->scriptPath = $scriptPath;
        return $this;
    }
}

