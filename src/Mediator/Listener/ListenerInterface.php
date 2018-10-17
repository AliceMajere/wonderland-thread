<?php

namespace Wonderland\Thread\Mediator\Listener;

use Wonderland\Thread\Mediator\Event\EventInterface;

interface ListenerInterface
{

	/**
	 * @return string
	 */
	public function getEventName(): string;

	/**
	 * @param callable $callback
	 * @return $this
	 */
	public function setCallback(callable $callback): self;

	/**
	 * @param EventInterface $event
	 * @return void
	 */
	public function notify(EventInterface $event);

}
