<?php

namespace WonderlandThread\Thread\Mediator\Listener;

use WonderlandThread\Thread\Mediator\Event\EventInterface;

/**
 * Interface ListenerInterface
 * @package WonderlandThread\Thread\Mediator\Listener
 */
interface ListenerInterface
{
    /**
     * @return string
     */
    public function getEventName();

    /**
     * @param callable $callback
     * @return $this
     */
    public function setCallback(callable $callback);

    /**
     * @param EventInterface $event
     * @return void
     */
    public function notify(EventInterface $event);

}
