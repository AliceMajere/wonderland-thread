<?php

namespace Wonderland\Thread\Tests\Mediator\Listener;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\PoolEvent;
use Wonderland\Thread\Mediator\Listener\AbstractListener;

/**
 * Class ListenerTest
 * @package Wonderland\Thread\Tests\Mediator\Listener
 * @author Alice Praud <alice.majere@gmail.com>
 */
class ListenerTest extends TestCase
{
	/** @var AbstractListener */
	private $listener;

	/** @var callable */
	private $callback;

	public function setUp()
	{
		$this->callback = function(){
  };
		$this->listener = new AbstractListener(PoolEvent::POOL_NEW_THREAD, $this->callback);
	}

	public function test_listener()
	{
		$this->assertSame(PoolEvent::POOL_NEW_THREAD, $this->listener->getEventName());
		$this->assertSame($this->listener, $this->listener->setEventName(PoolEvent::POOL_POST_WAIT_TICK));
		$this->assertSame(PoolEvent::POOL_POST_WAIT_TICK, $this->listener->getEventName());
		$this->assertSame($this->listener, $this->listener->setCallback($this->callback));
		$this->listener->notify(new PoolEvent('test'));
	}

}
