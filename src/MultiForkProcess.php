<?php
/**
 *  SAGI DATABASE ORM FILE
 *
 */

namespace Sagi\Process;


class MultiForkProcess
{

    /**
     * @var array<ForkProcess>
     */
    protected $processes;

    public function __construct(array $processes = [])
    {
        $this->setProcesses($processes);
    }


    public function run(){
        foreach($this->processes as $process){
            $process->start()->run();
        }
    }

    /**
     * @return array
     */
    public function getProcesses()
    {
        return $this->processes;
    }

    /**
     * @param array $processes
     * @return MultiForkProcess
     */
    public function setProcesses($processes)
    {
        $this->processes = $processes;
        return $this;
    }

}
