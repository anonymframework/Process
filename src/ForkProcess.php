<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;

/**
 * Class ForkProcess
 * @package Sagi\Process
 */
class ForkProcess implements ProcesserInterface
{

    /**
     * @var callable
     */
    protected $parentProcess;

    /**
     * @var array
     */
    protected $parentParameters = [];

    /**
     * @var callable
     */
    protected $childProcess;

    /**
     * @var array
     */
    protected $childParameters = [];

    /**
     * @var int
     */
    protected $pid;
    /**
     * ForkProcess constructor.
     * @param ProcessInterface|null $parentProcess
     * @param ProcessInterface|null $childProcess
     */
    public function __construct($parentProcess = null, $childProcess = null)
    {
        $this->setChildProcess($childProcess)->setParentProcess($parentProcess);
    }


    /**
     * @return ProcessInterface
     */
    public function getParentProcess()
    {
        return $this->parentProcess;
    }

    /**
     * @param ProcessInterface $parentProcess
     * @return ForkProcess
     */
    public function setParentProcess(ProcessInterface $parentProcess)
    {
        $this->parentProcess = $parentProcess;
        return $this;
    }

    /**
     * @return ProcessInterface
     */
    public function getChildProcess()
    {
        return $this->childProcess;
    }

    /**
     * @param ProcessInterface $childProcess
     * @return ForkProcess
     */
    public function setChildProcess(ProcessInterface $childProcess)
    {
        $this->childProcess = $childProcess;
        return $this;
    }

    /**
     * @return array
     */
    public function getParentParameters()
    {
        return $this->parentParameters;
    }

    /**
     * @param array $parentParameters
     * @return ForkProcess
     */
    public function setParentParameters($parentParameters)
    {
        $this->parentParameters = $parentParameters;
        return $this;
    }

    /**
     * @return array
     */
    public function getChildParameters()
    {
        return $this->childParameters;
    }

    /**
     * @param array $childParameters
     * @return ForkProcess
     */
    public function setChildParameters($childParameters)
    {
        $this->childParameters = $childParameters;
        return $this;
    }


    /**
     *
     * @throws ForkException
     * @return ForkProcess
     */
    public function start()
    {
        if (!function_exists('pcntl_fork')) {
            throw new ForkException('ForkProcess only works in cgi mode');
        }

        $this->pid = pcntl_fork();

        return $this;
    }

    /**
     * @throws ForkException
     */
    public function run()
    {
        if ($this->pid === -1) {
            $error = pcntl_strerror(pcntl_get_last_error());

            throw new ForkException(sprintf('Something went wrong, error : %s', $error));
        }elseif($this->pid === 0){
            $this->getChildProcess()->run($this->getChildParameters());
        }else{
            $this->getParentProcess()->run($this->getParentParameters());

            pcntl_wait($status);
        }
    }
}
