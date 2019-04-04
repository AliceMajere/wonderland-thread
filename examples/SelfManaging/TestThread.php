<?php

namespace Wonderland\Thread\Example\SelfManaging;

use Wonderland\Thread\AbstractThread;

class TestThread extends AbstractThread {

    /**
     * @var array
     */
    private $dependencies;

    /**
     * TestThread constructor.
     *
     * @param string $processName
     * @param        $dependencies
     */
    public function __construct(string $processName, $dependencies)
    {
        parent::__construct($processName);
        $this->dependencies = $dependencies;
    }

    /**
     * @param $processName
     * @param $date
     * @return int
     */
    protected function process($processName, $date)
    {
        echo $processName . " " . $date . PHP_EOL;

        sleep(1);

        return self::EXIT_STATUS_SUCCESS;
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
}