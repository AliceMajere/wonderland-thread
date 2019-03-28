<?php

namespace Wonderland\Thread\Tests\Mediator;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\PoolEvent;
use Wonderland\Thread\Mediator\Listener\AbstractListener;
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
		$listener = new AbstractListener(PoolEvent::POOL_NEW_THREAD, function() {
  });
		$this->assertSame([], $this->mediator->getListeners());
		$this->assertSame($this->mediator, $this->mediator->addListener($listener));
		$this->assertSame([PoolEvent::POOL_NEW_THREAD => [$listener]], $this->mediator->getListeners());
		$this->assertSame($this->mediator, $this->mediator->removeListener(new AbstractListener('fake', function(){
  })));
		$this->mediator->notify(PoolEvent::POOL_NEW_THREAD, new PoolEvent('unit-event'));
		$this->assertSame($this->mediator, $this->mediator->removeListener($listener));
	}

}
