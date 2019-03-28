<?php

namespace Wonderland\Thread\Tests\Implementation;

use Wonderland\Thread\AbstractThread;

class ExceptionThread extends AbstractThread
{
    /**
     * Return the name of the method to process during the thread
     *
     * @return string
     */
    protected function getMethodName(): string
    {
        return 'method';
    }

    /**
     * Return the list of dependencies that will be passed as parameters of the method referenced by getMethodName
     *
     * @return array
     */
    protected function getDependencies(): array
    {
        return ['toto'];
}}