<?php

namespace Wonderland\Thread\Mediator\Listener;

use Wonderland\Thread\Mediator\Event\EventInterface;

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
	public function __construct(string $eventName, callable $callback = null)
	{
		$this->eventName = $eventName;
		$this->callback = $callback;
	}

	/**
	 * @inheritDoc
	 */
	public function getEventName(): string
	{
		return $this->eventName;
	}

	/**
	 * @inheritDoc
	 */
	public function setEventName(string $eventName): self
	{
		$this->eventName = $eventName;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function setCallback(callable $callback): ListenerInterface
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
