<?php

namespace Wonderland\Thread\Mediator\Listener;

use Wonderland\Thread\Mediator\Event\EventInterface;

abstract class AbstractListener implements ListenerInterface
{
    /**
     * @param EventInterface $event
     */
	public function notify(EventInterface $event)
	{
	    $mapping = $this->getEventMapping();
	    if (false === isset($mapping[$event->getEventName()])) {
	        return;
        }

        call_user_func(
            [$this, $mapping[$event->getEventName()]],
            $event
        );
	}
}
