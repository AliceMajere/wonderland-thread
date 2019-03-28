<?php

namespace Wonderland\Thread\Tests\Mediator;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\PoolEvent;
use Wonderland\Thread\Mediator\Listener\AbstractListener;
use Wonderland\Thread\Mediator\Mediator;
use Wonderland\Thread\Tests\Implementation\TestListener;

/**
 * Class MediatorTest
 * @package Wonderland\Thread\Tests\Mediator
 * @author Alice Praud <alice.majere@gmail.com>
 */
class MediatorTest extends TestCase
{
	/** @var Mediator */
	private $mediator;

	public function setUp()
	{
		$this->mediator = new Mediator();
	}

	public function test_listeners()
	{
		$listener = new TestListener();
		$this->assertSame([], $this->mediator->getListeners());
		$this->assertSame($this->mediator, $this->mediator->addListener($listener));
		$this->assertSame([$listener], $this->mediator->getListeners());
		$this->assertSame($this->mediator, $this->mediator->removeListener(new TestListener()));
		$this->mediator->notify(new PoolEvent(PoolEvent::POOL_NEW_THREAD));
		$this->assertSame($this->mediator, $this->mediator->removeListener($listener));
	}

}
