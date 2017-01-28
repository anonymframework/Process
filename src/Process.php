<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;

/**
 * Class Process
 * @package Sagi\Process
 */
class Process implements ProcessInterface
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * @var mixed
     */
    private $result;

    /**
     * Process constructor.
     * @param callable|null $callable
     */
    public function __construct(callable  $callable = null)
    {
        $this->setCallable($callable);
    }


    /**
     * @param array $parameters
     * @return $this
     */
    public function run(array $parameters){
        $this->setResult(call_user_func_array($this->getCallable(), $parameters));

        return $this;
    }

    /**
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * @param callable $callable
     * @return Process
     */
    public function setCallable($callable)
    {
        $this->callable = $callable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     * @return Process
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
}
