<?php

namespace WonderlandThread\Thread\Mediator\Listener;

use WonderlandThread\Thread\Mediator\Event\EventInterface;

/**
 * Class Listener
 * @package WonderlandThread\Thread\Mediator\Listener
 */
class Listener implements ListenerInterface
{
    /** @var string $eventName */
    private $eventName;

    /** @var callable $callback */
    private $callback;

    /**
     * Listener constructor.
     * @param string $eventName
     * @param callable|null $callback
     */
    public function __construct($eventName, callable $callback = null)
    {
        $this->eventName = $eventName;
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @inheritDoc
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCallback(callable $callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function notify(EventInterface $event)
    {
        ($this->callback)($event);
    }

}
