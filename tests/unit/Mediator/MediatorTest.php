<?php

namespace Wonderland\Thread\Tests\Mediator;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\Event;
use Wonderland\Thread\Mediator\Listener\Listener;
use Wonderland\Thread\Mediator\Mediator;

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
		$listener = new Listener(Event::POOL_NEW_THREAD, function() {
  });
		$this->assertSame([], $this->mediator->getListeners());
		$this->assertSame($this->mediator, $this->mediator->addListener($listener));
		$this->assertSame([Event::POOL_NEW_THREAD => [$listener]], $this->mediator->getListeners());
		$this->assertSame($this->mediator, $this->mediator->removeListener(new Listener('fake', function(){
  })));
		$this->mediator->notify(Event::POOL_NEW_THREAD, new Event('unit-event'));
		$this->assertSame($this->mediator, $this->mediator->removeListener($listener));
	}

}
