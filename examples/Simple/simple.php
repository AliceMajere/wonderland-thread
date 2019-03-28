<?php

use Wonderland\Thread\Example\Simple\TestListener;
use Wonderland\Thread\Example\Simple\TestThread;
use Wonderland\Thread\ThreadPool;

require __DIR__.'/../../vendor/autoload.php';

/**
 * @param $increment
 * @return TestThread
 */
function createThread($increment)
{
    try {
        $date = new \DateTime();
    } catch (Exception $e) {
        echo "error date" . PHP_EOL;
    }

    return new TestThread('thread_' . $increment, [$date->format('H:i:s')]);
}

// we init the pool
$pool = new ThreadPool();
// we set the max number of running threads
$pool->setMaxRunningThreadNb(5);

// we create the threads and add them to the pool
$totalThread = 10;
for ($i = 1; $i <= $totalThread; $i++) {
    $pool->addThread(createThread($i));
}

// we add a listener
$listener = new TestListener();
$pool->addListener($listener);

// we run the pool
$pool->run();

// we remove the listener
$pool->removeListener($listener);