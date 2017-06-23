<?php

namespace Alicemajere\Thread\Factory;

use Alicemajere\Thread\Thread;

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
