<?php

namespace Wonderland\Thread\Factory;

use Wonderland\Thread\Thread;

class ThreadFactory
{
	/**
	 * @param $processName
	 * @param callable $function
	 * @return Thread
	 */
	public static function create(string $processName, callable $function): Thread
	{
		$thread = new Thread();
		$thread->setCallback($function);
		$thread->setProcessName($processName);

		return $thread;
	}

}
