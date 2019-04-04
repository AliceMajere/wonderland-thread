<?php

namespace Wonderland\Thread;

use Wonderland\Thread\Mediator\Event\EventInterface;
use Wonderland\Thread\Mediator\Mediator;

class AbstractThreadMediator
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

	public function setMediator(Mediator $mediator)
	{
		$this->mediator = $mediator;
	}

	/**
	 * @param EventInterface $event
	 */
	protected function notify(EventInterface $event)
	{
		$this->getMediator()->notify($event);
	}

}
