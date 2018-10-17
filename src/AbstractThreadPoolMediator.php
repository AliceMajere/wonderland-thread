<?php

namespace Wonderland\Thread;

use Wonderland\Thread\Mediator\Listener\ListenerInterface;
use Wonderland\Thread\Mediator\Mediator;
use Wonderland\Thread\Factory\EventFactory;

abstract class AbstractThreadPoolMediator
{
	/** @var Mediator */
	private $mediator;

	/**
	 * @return Mediator
	 */
	public function getMediator()
	{
		return $this->mediator;
	}

	/**
	 * ThreadPoolMediator constructor.
	 */
	public function __construct()
	{
		$this->mediator = new Mediator();
	}

	/**
	 * @param ListenerInterface $listener
	 * @return AbstractThreadPoolMediator
	 */
	public function addListener(ListenerInterface $listener): self
	{
		$this->mediator->addListener($listener);

		return $this;
	}

	/**
	 * @param ListenerInterface $listener
	 * @return AbstractThreadPoolMediator
	 */
	public function removeListener(ListenerInterface $listener): self
	{
		$this->mediator->removeListener($listener);

		return $this;
	}

	/**
	 * @param string $eventName
	 * @param Thread|null $thread
	 */
	public function notify(string $eventName, ?Thread $thread = null)
	{
		$this->getMediator()->notify($eventName, EventFactory::create($eventName, $this, $thread));
	}

}
