<?php

namespace Wonderland\Thread\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Wonderland\Thread\Factory\ThreadFactory;
use Wonderland\Thread\Thread;

/**
 * Class ThreadFactoryTest
 * @package Wonderland\Thread\Tests\Factory
 * @author Alice Praud <alice.majere@gmail.com>
 */
class ThreadFactoryTest extends TestCase
{

	public function test_create()
	{
		$callback = function(){
  };
		$thread = new Thread();
		$thread->setProcessName('unit-test');
		$thread->setCallback($callback);

		$this->assertSame($thread->getCallback(), ThreadFactory::create('unit-test', $callback)->getCallback());
		$this->assertSame($thread->getProcessName(), ThreadFactory::create('unit-test', $callback)->getProcessName());
	}

}
