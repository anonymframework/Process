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
    protected $parentParameters;

    /**
     * @var callable
     */
    protected $childProcess;

    /**
     * @var array
     */
    protected $childParameters;
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
     * @return callable
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
     * @return callable
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
     * @return mixed
     */
    public function start()
    {

    }

    /**
     * @return mixed
     */
    public function run()
    {

    }
}
