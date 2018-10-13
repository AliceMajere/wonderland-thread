<?php

namespace WonderlandThread\Thread\Factory;

use WonderlandThread\Thread\Event\Event;
use WonderlandThread\Thread\Thread;
use WonderlandThread\Thread\ThreadPool;
use WonderlandThread\Thread\AbstractThreadPoolMediator;

/**
 * Class EventFactory
 * @package WonderlandThread\Thread\Factory
 */
class EventFactory
{
    /**
     * @param string $eventName
     * @param ThreadPool|AbstractThreadPoolMediator $pool
     * @param Thread|null $thread
     * @return Event
     */
    public static function create($eventName, $pool, $thread = null)
    {
        $event = new Event($eventName);
        $event->setThreadNb(count($pool->getThreads()));
        $event->setThreadDoneNb(count($pool->getThreads()) - count($pool->getToRunThreads()));
        $event->setMaxRunningThreadNb($pool->getMaxRunningThreadNb());
        $event->setThreadLeftNb(count($pool->getToRunThreads()));
        $event->setRunningThreadNb(count($pool->getRunningThreads()));
        $event->setThread($thread);

        return $event;
    }
}
