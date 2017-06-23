<?php

namespace Alicemajere\Thread\Mediator\Listener;

use Alicemajere\Thread\Mediator\Event\EventInterface;

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
