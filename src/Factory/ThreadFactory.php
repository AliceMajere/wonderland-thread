<?php

namespace WonderlandThread\Thread\Factory;

use WonderlandThread\Thread\Thread;

/**
 * Class ThreadFactory
 * @package WonderlandThread\Thread\Factory
 */
class ThreadFactory
{
    /**
     * @param $processName
     * @param callable $function
     * @return Thread
     */
    public static function create($processName, callable $function)
    {
        $thread = new Thread();
        $thread->setCallback($function);
        $thread->setProcessName($processName);

        return $thread;
    }
}
