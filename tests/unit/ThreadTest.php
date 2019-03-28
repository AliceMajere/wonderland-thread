<?php

namespace Wonderland\Thread\Tests;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Exception\ThreadException;
use Wonderland\Thread\AbstractThread;
use Wonderland\Thread\Mediator\Mediator;
use Wonderland\Thread\Tests\Implementation\ErrorThread;
use Wonderland\Thread\Tests\Implementation\ExceptionThread;
use Wonderland\Thread\Tests\Implementation\SuccessThread;

/**
 * Class ThreadTest
 * @package Wonderland\Thread\Tests
 * @author Alice Praud <alice.majere@gmail.com>
 */
class ThreadTest extends TestCase
{
	/** @var AbstractThread */
	private $thread;

	public function setUp()
	{
		$this->thread = new SuccessThread('unit-test');
		$this->thread->setMediator(new Mediator());
		$this->thread->setPid(1);
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
	}

	/**
	 * @throws ThreadException
	 */
	public function test_run()
	{
		$this->assertSame(0, $this->thread->run());
	}

	/**
	 * @throws ThreadException
	 */
	public function test_run_exception()
	{
		$this->expectException(ThreadException::class);
		$thread = new ExceptionThread('unit-test');
		$thread->run();

	}

	/**
	 * @throws ThreadException
	 */
	public function test_run_exception_status()
	{
		$this->expectException(ThreadException::class);
		$thread = new ErrorThread('unit-test');
		$thread->run();
	}

}
