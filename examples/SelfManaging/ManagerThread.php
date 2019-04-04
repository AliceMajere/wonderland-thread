<?php

namespace Wonderland\Thread\Example\SelfManaging;


use Wonderland\Thread\AbstractThread;
use Wonderland\Thread\ThreadPool;

class ManagerThread extends AbstractThread
{
    /**
     * @var array
     */
    private $dependencies = [];

    public function __construct(string $processName, array $dependencies)
    {
        $this->dependencies = $dependencies;
        parent::__construct($processName);
    }

    /**
     * Return the name of the method to process during the thread
     *
     * @return string
     */
    protected function getMethodName(): string
    {
        return 'process';
    }

    /**
     * Return the list of dependencies that will be passed as parameters of the method referenced by getMethodName
     *
     * @return array
     */
    protected function getDependencies(): array
    {
        return $this->dependencies;
    }

    /**
     * @param string     $processName
     * @param ThreadPool $pool
     * @return int
     */
    public function process(string $processName, ThreadPool &$pool)
    {
        for ($i = 0; $i < 10; $i++) {
            $pool->addLiveThread(new TestThread($processName . '_' . $i, []));
            echo "Added Thread " . $i . PHP_EOL;
//            echo count($pool->getRunningThreads()) . PHP_EOL;
            sleep(1);
        }

        echo '== end Manage Thread ==' . PHP_EOL;

        return self::EXIT_STATUS_SUCCESS;
    }
}