<?php

namespace Wonderland\Thread\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\PoolEvent;
use Wonderland\Thread\Factory\EventPoolFactory;
use Wonderland\Thread\Factory\ThreadFactory;
use Wonderland\Thread\AbstractThread;
use Wonderland\Thread\Tests\Implementation\SuccessThread;
use Wonderland\Thread\ThreadPool;

/**
 * Class ThreadFactoryTest
 * @package Wonderland\Thread\Tests\Factory
 * @author Alice Praud <alice.majere@gmail.com>
 */
class EventPoolFactoryTest extends TestCase
{

	public function test_create()
	{
		$pool = new ThreadPool();
		$thread = new SuccessThread('unit-test');
		$event = new PoolEvent('unit-test');
		$factoryEvent = EventPoolFactory::create('unit-test', $pool, $thread);

		$this->assertSame($event->getEventName(), $factoryEvent->getEventName());
		$this->assertSame($event->getThreadLeftNb(), $factoryEvent->getThreadLeftNb());
		$this->assertSame($event->getMaxRunningThreadNb(), $factoryEvent->getMaxRunningThreadNb());
		$this->assertSame($event->getRunningThreadNb(), $factoryEvent->getRunningThreadNb());
		$this->assertSame($event->getThreadDoneNb(), $factoryEvent->getThreadDoneNb());
		$this->assertSame($event->getThreadNb(), $factoryEvent->getThreadNb());
	}

}
