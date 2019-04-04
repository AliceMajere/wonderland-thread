<?php

namespace Wonderland\Thread\Factory;

use Wonderland\Thread\AbstractThreadPoolMediator;
use Wonderland\Thread\Event\PoolEvent;
use Wonderland\Thread\AbstractThread;
use Wonderland\Thread\ThreadPool;

class EventPoolFactory
{

	/**
	 * @param string                                $eventName
	 * @param ThreadPool|AbstractThreadPoolMediator $pool
	 * @param AbstractThread|null                   $thread
	 * @return PoolEvent
	 */
	public static function create(
		string $eventName,
		AbstractThreadPoolMediator $pool,
		?AbstractThread $thread = null
	): PoolEvent
	{
		$event = new PoolEvent($eventName);
		$event->setThreadNb(count($pool->getThreads()));
		$event->setThreadDoneNb(count($pool->getThreads()) - count($pool->getToRunThreads()));
		$event->setMaxRunningThreadNb($pool->getMaxRunningThreadNb());
		$event->setThreadLeftNb(count($pool->getToRunThreads()));
		$event->setRunningThreadNb(count($pool->getRunningThreads()));
		$event->setThread($thread);

		return $event;
	}

}
