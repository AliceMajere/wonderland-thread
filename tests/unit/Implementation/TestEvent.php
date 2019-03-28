<?php

namespace Wonderland\Thread\Tests\Implementation;


use Wonderland\Thread\Mediator\Event\EventInterface;

class TestEvent implements EventInterface
{
    /**
     * @return string
     */
    public function getEventName(): string
    {
        return 'test-unit-event';
    }
}