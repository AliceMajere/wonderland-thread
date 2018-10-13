<?php

namespace WonderlandThread\Thread;

use WonderlandThread\Thread\Mediator\Listener\ListenerInterface;
use WonderlandThread\Thread\Mediator\Mediator;
use WonderlandThread\Thread\Factory\EventFactory;

/**
 * Class AbstractThreadPoolMediator
 * @package WonderlandThread\Thread
 */
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
