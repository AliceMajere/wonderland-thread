<?php

namespace Wonderland\Thread\Tests\Mediator\Listener;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\Event;
use Wonderland\Thread\Mediator\Listener\Listener;

/**
 * Class ListenerTest
 * @package Wonderland\Thread\Tests\Mediator\Listener
 * @author Alice Praud <alice.majere@gmail.com>
 */
class ListenerTest extends TestCase
{
	/** @var Listener */
	private $listener;

	/** @var callable */
	private $callback;

	public function setUp()
	{
		$this->callback = function(){
  };
		$this->listener = new Listener(Event::POOL_NEW_THREAD, $this->callback);
	}

	public function test_listener()
	{
		$this->assertSame(Event::POOL_NEW_THREAD, $this->listener->getEventName());
		$this->assertSame($this->listener, $this->listener->setEventName(Event::POOL_POST_WAIT_TICK));
		$this->assertSame(Event::POOL_POST_WAIT_TICK, $this->listener->getEventName());
		$this->assertSame($this->listener, $this->listener->setCallback($this->callback));
		$this->listener->notify(new Event('test'));
	}

}
