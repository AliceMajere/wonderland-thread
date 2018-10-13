<?php

namespace Wonderland\Thread;

use Wonderland\Thread\Exception\ThreadException;

class Thread
{
    const EXIT_STATUS_SUCCESS = 0;
    const EXIT_STATUS_ERROR = 1;

    /** @var int $pid */
    private $pid;

    /** @var string $processName */
    private $processName;

    /** @var callable $callback */
    private $callback;

    /**
     * @return int
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param int $pid
     * @return Thread
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcessName()
    {
        return $this->processName;
    }

    /**
     * @param string $processName
     * @return Thread
     */
    public function setProcessName($processName)
    {
        $this->processName = $processName;

        return $this;
    }

    /**
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param callable $callback
     * @return Thread
     */
    public function setCallback(callable $callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @param string $processName
     * @return int
     * @throws ThreadException
     */
    public function run($processName)
    {
        if (null === $this->callback) {
            throw new ThreadException('No callback function defined for the thread');
        }

        $status = ($this->callback)($processName);

        if (null === $status) {
            throw new ThreadException("Error. You must return a process status in your callback function");
        }

        return $status;
    }

}
