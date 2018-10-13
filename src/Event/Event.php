<?php

namespace WonderlandThread\Thread\Event;

use WonderlandThread\Thread\Mediator\Event\EventInterface;
use WonderlandThread\Thread\Thread;

/**
 * Class Event
 * @package WonderlandThread\Thread\Event
 */
class Event implements EventInterface
{
    const POOL_RUN_START = 1;
    const POOL_RUN_STOP = 2;
    const POOL_NEW_THREAD = 3;
    const POOL_PRE_WAIT_TIC = 4;
    const POOL_POST_WAIT_TIC = 5;
    const POOL_WAIT_TIC_PID = 6;
    const POOL_WAIT_TIC_PID_REMOVED = 7;

    const THREAD_PRE_PROCESS = 8;
    const THREAD_POST_PROCESS = 9;
    const THREAD_EXIT_SUCCESS = 10;
    const THREAD_EXIT_ERROR = 11;
    const THREAD_EXIT_UNKNOWN = 12;

    /** @var string $eventName */
    private $eventName;

    /** @var int $threadNb */
    private $threadNb;

    /** @var int $runningThreadNb */
    private $runningThreadNb;

    /** @var int $threadDoneNb */
    private $threadDoneNb;

    /** @var int $threadLeftNb */
    private $threadLeftNb;

    /** @var int $maxRunningThreadNb */
    private $maxRunningThreadNb;

    /** @var Thread $thread */
    private $thread;

    /**
     * ThreadPoolEvent constructor.
     * @param string $eventName
     */
    public function __construct($eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param string $eventName
     * @return Event
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * @return int
     */
    public function getThreadNb()
    {
        return $this->threadNb;
    }

    /**
     * @param int $threadNb
     * @return Event
     */
    public function setThreadNb($threadNb)
    {
        $this->threadNb = $threadNb;

        return $this;
    }

    /**
     * @return int
     */
    public function getThreadDoneNb()
    {
        return $this->threadDoneNb;
    }

    /**
     * @param int $threadDoneNb
     * @return Event
     */
    public function setThreadDoneNb($threadDoneNb)
    {
        $this->threadDoneNb = $threadDoneNb;

        return $this;
    }

    /**
     * @return int
     */
    public function getThreadLeftNb()
    {
        return $this->threadLeftNb;
    }

    /**
     * @param int $threadLeftNb
     * @return Event
     */
    public function setThreadLeftNb($threadLeftNb)
    {
        $this->threadLeftNb = $threadLeftNb;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxRunningThreadNb()
    {
        return $this->maxRunningThreadNb;
    }

    /**
     * @param int $maxRunningThreadNb
     * @return Event
     */
    public function setMaxRunningThreadNb($maxRunningThreadNb)
    {
        $this->maxRunningThreadNb = $maxRunningThreadNb;

        return $this;
    }

    /**
     * @return int
     */
    public function getRunningThreadNb()
    {
        return $this->runningThreadNb;
    }

    /**
     * @param int $runningThreadNb
     * @return Event
     */
    public function setRunningThreadNb($runningThreadNb)
    {
        $this->runningThreadNb = $runningThreadNb;

        return $this;
    }

    /**
     * @return Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param Thread|null $thread
     * @return $this
     */
    public function setThread(Thread $thread = null)
    {
        $this->thread = $thread;

        return $this;
    }

}
