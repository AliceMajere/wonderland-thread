<?php

namespace Wonderland\Thread;

use Wonderland\Thread\Mediator\Listener\ListenerInterface;
use Wonderland\Thread\Mediator\Mediator;
use Wonderland\Thread\Factory\EventPoolFactory;

abstract class AbstractThreadPoolMediator
{
	/** @var Mediator */
	private $mediator;

	/**
	 * @return Mediator
	 */
	protected function getMediator()
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
	 * @param string              $eventName
	 * @param AbstractThread|null $thread
	 */
	protected function notify(string $eventName, ?AbstractThread $thread = null)
	{
		$this->getMediator()->notify(EventPoolFactory::create($eventName, $this, $thread));
	}

}
