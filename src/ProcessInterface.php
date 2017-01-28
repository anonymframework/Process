<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;

/**
 * Interface ProcessInterface
 * @package Sagi\Process
 */
interface ProcessInterface
{
    /**
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters);
}
