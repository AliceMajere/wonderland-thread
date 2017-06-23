<?php

namespace Alicemajere\Thread;

use Alicemajere\Thread\Mediator\Listener\ListenerInterface;
use Alicemajere\Thread\Mediator\Mediator;
use Alicemajere\Thread\Factory\EventFactory;

abstract class AbstractThreadPoolMediator
{
    /** @var Mediator */
    private $mediator;

    /**
     * @return Mediator
     */
    public function getMediator()
    {
        return $this->mediator;
    }

    /**
     * ThreadPoolMediator constructor.
     */
    public function __construct()
    {
        $this->mediator = new Mediator();
    }

    /**
     * @param ListenerInterface $listener
     */
    public function addListener(ListenerInterface $listener)
    {
        $this->mediator->addListener($listener);
    }

    /**
     * @param ListenerInterface $listener
     */
    public function removeListener(ListenerInterface $listener)
    {
        $this->mediator->removeListener($listener);
    }

    /**
     * @param string $eventName
     * @param Thread|null $thread
     */
    public function notify($eventName, $thread = null)
    {
        $this->getMediator()->notify($eventName, EventFactory::create($eventName, $this, $thread));
    }
}
