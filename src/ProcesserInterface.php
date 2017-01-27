<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;

/**
 * Interface ProcesserInterface
 * @package Sagi\Process
 */
interface ProcesserInterface
{

    /**
     * @return mixed
     */
    public function start();

    /**
     * @return mixed
     */
    public function run();
}
