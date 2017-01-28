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
    protected $argc = 1;

    /**
     * @var array
     */
    protected $argv = [];

    /**
     * OpenProcess constructor.
     * @param string $path

     */
    public function __construct($path = __FILE__)
    {
        if (isset($_SERVER['argv'])) {
            $this->argc = $_SERVER['argc'];
            $this->argv = $_SERVER['argv'];
        }


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
     * @return bool|ProcessResult
     */
    public function execProcess($name)
    {
        if ($this->argc === 1) {
            if (version_compare(PHP_VERSION, '5.4.0', '>')) {
                $php = PHP_BINARY;
            } else {
                $php = 'php';
            }

            if ($php === '') {
                $php = 'php';
            }

            $cont = popen(sprintf('%s %s --run %s', $php, $this->getScriptPath(), $name), 'r');

            return new ProcessResult($cont);
        }else{
            return new ProcessResult();
        }
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
