<?php

namespace WonderlandThread\Thread\Mediator;

use WonderlandThread\Thread\Mediator\Event\EventInterface;
use WonderlandThread\Thread\Mediator\Listener\ListenerInterface;

/**
 * Class Mediator
 * @package WonderlandThread\Thread\Mediator
 */
class Mediator
{
    /** @var ListenerInterface[][] */
    private $listeners;

    /**
     * @return ListenerInterface[][]
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * @param ListenerInterface $listener
     */
    public function addListener(ListenerInterface $listener)
    {
        $this->listeners[$listener->getEventName()][] = $listener;
   }

    /**
     * @param ListenerInterface $listener
     */
    public function removeListener(ListenerInterface $listener)
    {
        if (!isset($this->listeners[$listener->getEventName()])) {
            return;
        }

        $key = array_search($listener, $this->listeners[$listener->getEventName()]);

        if (false !== $key) {
            unset($this->listeners[$listener->getEventName()][$key]);
        }

        if (empty($this->listeners[$listener->getEventName()])) {
            unset($this->listeners[$listener->getEventName()]);
        }
    }

    /**
     * @param string $eventName
     * @param EventInterface $event
     */
    public function notify($eventName, EventInterface $event)
    {
        if (!isset($this->listeners[$eventName])) {
            return;
        }

        foreach ($this->listeners[$eventName] as $listener) {
            $listener->notify($event);
        }
    }
}
