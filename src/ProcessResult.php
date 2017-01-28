<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;


class ProcessResult
{
    /**
     * @var string
     */
    protected $result;

    /**
     * @var resource
     */
    protected $resource;

    /**
     * ProcessResult constructor.
     * @param resource $resource
     */
    public function __construct($resource = null)
    {
        $this->resource = $resource;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        if (!is_null($this->resource)) {
            if (is_null($this->result)) {
               $this->setResult($result = stream_get_contents($this->resource));
            }

            return $result;
        }


        return;
    }

    /**
     * @param string $result
     * @return ProcessResult
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
}
