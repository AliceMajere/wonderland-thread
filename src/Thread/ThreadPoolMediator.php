<?php

namespace Alicemajere\Thread;

use Alicemajere\Thread\Mediator\Listener\ListenerInterface;
use Alicemajere\Thread\Mediator\Mediator;
use Alicemajere\Thread\Factory\EventFactory;

class ThreadPoolMediator
{
    /** @var ThreadPoolMediator */
    private $mediator;

    /**
     * @return ThreadPoolMediator
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
