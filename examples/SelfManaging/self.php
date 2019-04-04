<?php

use Wonderland\Thread\Example\SelfManaging\ManagerThread;
use Wonderland\Thread\ThreadPool;

require __DIR__.'/../../vendor/autoload.php';

$pool = new ThreadPool();
$pool->setMaxRunningThreadNb(3);

$pool->addThread(new ManagerThread('manager_thread', [&$pool]));
var_dump($pool);
$pool->run();
