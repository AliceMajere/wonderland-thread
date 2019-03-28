<?php

namespace Wonderland\Thread\Mediator\Listener;

use Wonderland\Thread\Mediator\Event\EventInterface;

interface ListenerInterface
{

	/**
	 * @return array
	 */
	public function getEventMapping(): array;

	/**
	 * @param EventInterface $event
	 * @return void
	 */
	public function notify(EventInterface $event);

}
