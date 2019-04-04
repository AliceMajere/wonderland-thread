<?php

namespace Wonderland\Thread\Example\Simple;


use Wonderland\Thread\Event\PoolEvent;
use Wonderland\Thread\Mediator\Listener\AbstractListener;

class TestListener extends AbstractListener
{
    /**
     * @return array
     */
    public function getEventMapping(): array
    {
        return [
            PoolEvent::POOL_WAIT_TICK_PID_REMOVED => 'onTickRemoved',
            TestEvent::EVENT_NAME => 'onTestEvent'
        ];
    }

    /**
     * @param PoolEvent $event
     */
    public function onTickRemoved(PoolEvent $event)
    {
        echo $event->getThreadLeftNb() . PHP_EOL;
    }

    /**
     * @param TestEvent $event
     */
    public function onTestEvent(TestEvent $event)
    {
        echo $event->getEventParam() . PHP_EOL;
    }
}