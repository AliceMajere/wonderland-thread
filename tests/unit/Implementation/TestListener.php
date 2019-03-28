<?php

namespace Wonderland\Thread\Tests\Implementation;


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
            PoolEvent::POOL_NEW_THREAD => 'onNewThread'
        ];
    }

    /**
     * @param PoolEvent $event
     */
    public function onNewThread(PoolEvent $event)
    {

    }
}