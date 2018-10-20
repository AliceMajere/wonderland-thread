<?php

namespace Wonderland\Thread\Tests;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Event\Event;
use Wonderland\Thread\Exception\ThreadException;
use Wonderland\Thread\Mediator\Listener\Listener;
use Wonderland\Thread\Mediator\Mediator;
use Wonderland\Thread\Thread;
use Wonderland\Thread\ThreadPool;

/**
 * Class ThreadPoolTest
 * @package Wonderland\Thread\Tests
 * @author Alice Praud <alice.majere@gmail.com>
 */
class ThreadPoolTest extends TestCase
{
	/** @var ThreadPool */
	private $threadPool;

	protected function setUp()
	{
		$this->threadPool = new ThreadPool();
	}

	public function test_constructor_destructor()
	{
		$this->assertAttributeEquals([], 'threads', $this->threadPool);
		$this->assertAttributeEquals([], 'runningThreads', $this->threadPool);
		$this->assertAttributeEquals([], 'toRunThreads', $this->threadPool);
		$this->assertAttributeEquals(false, 'isRunning', $this->threadPool);
		$this->assertAttributeEquals(0, 'maxRunningThreadNb', $this->threadPool);
		$this->assertSame(Mediator::class, get_class($this->threadPool->getMediator()));

		unset($this->threadPool);
	}

	public function test_getThreads()
	{
		$threads = [new Thread()];
		$this->assertSame($this->threadPool, $this->threadPool->setThreads($threads));
		$this->assertSame($threads, $this->threadPool->getThreads());
	}

	public function test_addThread()
	{
		$thread = new Thread();
		$this->assertSame($this->threadPool, $this->threadPool->addThread($thread));
		$this->assertContains($thread, $this->threadPool->getThreads());
	}

	public function test_getMaxRunningThreadNb()
	{
		$this->assertSame(0, $this->threadPool->getMaxRunningThreadNb());
	}

	public function test_setMaxRunningThreadNb()
	{
		$this->assertSame($this->threadPool, $this->threadPool->setMaxRunningThreadNb(10));
		$this->assertSame(10, $this->threadPool->getMaxRunningThreadNb());
	}

	public function test_getToRunThreads()
	{
		$this->assertSame([], $this->threadPool->getToRunThreads());
	}

	public function test_getRunningThreads()
	{
		$this->assertSame([], $this->threadPool->getRunningThreads());
	}

	/**
	 * @throws \Wonderland\Thread\Exception\ThreadException
	 */
	public function test_run()
	{
		$thread = new Thread();
		$thread->setCallback(function (){ return 0;

  });
		$thread->setProcessName('unitTest');
		$threads = [];
		$listener = new Listener(Event::POOL_NEW_THREAD, function (){
  });

		$this->threadPool->setMaxRunningThreadNb(10);
		$this->assertSame($this->threadPool, $this->threadPool->addListener($listener));
		for ($i = 0; $i < 20;
$i++) { $threads[] = clone $thread;
		}
		$this->assertSame($this->threadPool, $this->threadPool->addThread($thread));
		$this->assertSame($this->threadPool, $this->threadPool->setThreads($threads));

		$this->threadPool->run();

		$this->assertSame($this->threadPool, $this->threadPool->removeListener($listener));
	}

	/**
	 * @throws ThreadException
	 */
	public function test_run_exception()
	{
		$this->expectException(ThreadException::class);
		$this->threadPool->run();

	}

}
