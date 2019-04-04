<?php

namespace Wonderland\Thread\Mediator;

use Wonderland\Thread\Mediator\Event\EventInterface;
use Wonderland\Thread\Mediator\Listener\ListenerInterface;

class Mediator
{
	/** @var ListenerInterface[] */
	private $listeners = [];

	/**
	 * @return ListenerInterface[]
	 */
	public function getListeners(): array
	{
		return $this->listeners;
	}

	/**
	 * @param ListenerInterface $listener
	 * @return Mediator
	 */
	public function addListener(ListenerInterface $listener): self
	{
		$this->listeners[] = $listener;

		return $this;
	}

	/**
	 * @param ListenerInterface $listener
	 * @return Mediator
	 */
	public function removeListener(ListenerInterface $listener): self
	{
		$key = array_search($listener, $this->listeners, true);
		if (false !== $key) {
			unset($this->listeners[$key]);
		}

		return $this;
	}

	/**
	 * @param EventInterface $event
	 */
	public function notify(EventInterface $event)
	{
		foreach ($this->listeners as $listener) {
			$listener->notify($event);
		}
	}

}
