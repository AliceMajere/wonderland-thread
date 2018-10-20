<?php

namespace Wonderland\Thread\Tests\Event;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\Event;
use Wonderland\Thread\Thread;

/**
 * Class EventTest
 * @package Wonderland\Thread\Tests\Event
 * @author Alice Praud <alice.majere@gmail.com>
 */
class EventTest extends TestCase
{
	/** @var Event */
	private $event;

	/** @var Thread */
	private $thread;

	public function setUp()
	{
		$this->thread = new Thread();
		$this->event = new Event('unit-test');
		$this->event->setThread($this->thread);
	}

	public function test_event()
	{
		$this->assertSame('unit-test', $this->event->getEventName());
		$this->assertSame(0, $this->event->getMaxRunningThreadNb());
		$this->assertSame(0, $this->event->getRunningThreadNb());
		$this->assertSame(0, $this->event->getThreadDoneNb());
		$this->assertSame(0, $this->event->getThreadLeftNb());
		$this->assertSame(0, $this->event->getThreadNb());
		$this->assertSame($this->thread, $this->event->getThread());

		$this->assertSame($this->event, $this->event->setThread($this->thread));
		$this->assertSame($this->event, $this->event->setMaxRunningThreadNb(100));
		$this->assertSame($this->event, $this->event->setEventName('fake'));
		$this->assertSame($this->event, $this->event->setRunningThreadNb(10));
		$this->assertSame($this->event, $this->event->setThreadDoneNb(90));
		$this->assertSame($this->event, $this->event->setThreadLeftNb(10));
		$this->assertSame($this->event, $this->event->setThreadNb(10));

		$this->assertSame('fake', $this->event->getEventName());
		$this->assertSame(100, $this->event->getMaxRunningThreadNb());
		$this->assertSame(10, $this->event->getRunningThreadNb());
		$this->assertSame(90, $this->event->getThreadDoneNb());
		$this->assertSame(10, $this->event->getThreadLeftNb());
		$this->assertSame(10, $this->event->getThreadNb());
	}

}
