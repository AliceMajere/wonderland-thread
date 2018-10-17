<?php

namespace Wonderland\Thread\Mediator;

use Wonderland\Thread\Mediator\Event\EventInterface;
use Wonderland\Thread\Mediator\Listener\ListenerInterface;

class Mediator
{
	/** @var ListenerInterface[][] */
	private $listeners = [];

	/**
	 * @return ListenerInterface[][]
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
		$this->listeners[$listener->getEventName()][] = $listener;

		return $this;
	}

	/**
	 * @param ListenerInterface $listener
	 * @return Mediator
	 */
	public function removeListener(ListenerInterface $listener): self
	{
		if (!isset($this->listeners[$listener->getEventName()])) {
			return $this;
		}

		$key = array_search($listener, $this->listeners[$listener->getEventName()]);

		if (false !== $key) {
			unset($this->listeners[$listener->getEventName()][$key]);
		}

		if (empty($this->listeners[$listener->getEventName()])) {
			unset($this->listeners[$listener->getEventName()]);
		}

		return $this;
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
