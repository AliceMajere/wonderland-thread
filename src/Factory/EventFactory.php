<?php

namespace Wonderland\Thread\Factory;

use Wonderland\Thread\AbstractThreadPoolMediator;
use Wonderland\Thread\Event\Event;
use Wonderland\Thread\Thread;
use Wonderland\Thread\ThreadPool;

class EventFactory
{

	/**
	 * @param string $eventName
	 * @param ThreadPool|AbstractThreadPoolMediator $pool
	 * @param Thread|null $thread
	 * @return Event
	 */
	public static function create(string $eventName, AbstractThreadPoolMediator $pool, ?Thread $thread = null): Event
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
