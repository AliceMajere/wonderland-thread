<?php

namespace Wonderland\Thread\Tests;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Exception\ThreadException;
use Wonderland\Thread\AbstractThread;

/**
 * Class ThreadTest
 * @package Wonderland\Thread\Tests
 * @author Alice Praud <alice.majere@gmail.com>
 */
class ThreadTest extends TestCase
{
	/** @var AbstractThread */
	private $thread;

	private $callback;

	public function setUp()
	{
		$this->callback = function (){ return 0;

  };

		$this->thread = new AbstractThread();
		$this->thread->setPid(1);
		$this->thread->setProcessName('unit-test');
		$this->thread->setCallback($this->callback);
	}

	public function test_pid()
	{
		$this->assertSame(1, $this->thread->getPid());
		$this->assertSame($this->thread, $this->thread->setPid(100));
		$this->assertSame(100, $this->thread->getPid());
	}

	public function test_processName()
	{
		$this->assertSame('unit-test', $this->thread->getProcessName());
		$this->assertSame($this->thread, $this->thread->setProcessName('unit'));
		$this->assertSame('unit', $this->thread->getProcessName());
	}

	public function test_callback()
	{
		$callback = function(){ return 1;

  };

		$this->assertSame($this->callback, $this->thread->getCallback());
		$this->assertSame($this->thread, $this->thread->setCallback($callback));
		$this->assertSame($callback, $this->thread->getCallback());
	}

	/**
	 * @throws ThreadException
	 */
	public function test_run()
	{
		$this->assertSame(0, $this->thread->run('unit-test'));
	}

	/**
	 * @throws ThreadException
	 */
	public function test_run_exception()
	{
		$this->expectException(ThreadException::class);
		$thread = new AbstractThread();
		$thread->run('unit-test');

	}

	/**
	 * @throws ThreadException
	 */
	public function test_run_exception_status()
	{
		$this->expectException(ThreadException::class);
		$thread = new AbstractThread();
		$thread->setCallback(function() { return null;

  });
		$thread->run('unit-test');
	}

}
