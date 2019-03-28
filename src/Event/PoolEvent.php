<?php

namespace Wonderland\Thread\Event;

use Wonderland\Thread\Mediator\Event\EventInterface;
use Wonderland\Thread\AbstractThread;

class PoolEvent implements EventInterface
{
	const POOL_RUN_START = 'run_start';
	const POOL_RUN_STOP = 'run_stop';
	const POOL_NEW_THREAD = 'new_thread';
	const POOL_PRE_WAIT_TICK = 'pre_wait_tick';
	const POOL_POST_WAIT_TICK = 'post_wait_tick';
	const POOL_WAIT_TICK_PID = 'wait_tick_pid';
	const POOL_WAIT_TICK_PID_REMOVED = 'wait_tick_pid_removed';

	const THREAD_PRE_PROCESS = 'pre_process';
	const THREAD_POST_PROCESS = 'post_process';
	const THREAD_EXIT_SUCCESS = 'exist_success';
	const THREAD_EXIT_ERROR = 'exit_error';
	const THREAD_EXIT_UNKNOWN = 'exit_unknown';

	/** @var string $eventName */
	private $eventName;

	/** @var int $threadNb */
	private $threadNb;

	/** @var int $runningThreadNb */
	private $runningThreadNb;

	/** @var int $threadDoneNb */
	private $threadDoneNb;

	/** @var int $threadLeftNb */
	private $threadLeftNb;

	/** @var int $maxRunningThreadNb */
	private $maxRunningThreadNb;

	/** @var AbstractThread $thread */
	private $thread;

	/**
	 * ThreadPoolEvent constructor.
	 * @param string $eventName
	 */
	public function __construct($eventName)
	{
		$this->eventName = $eventName;
		$this->threadNb = 0;
		$this->runningThreadNb = 0;
		$this->threadDoneNb = 0;
		$this->threadLeftNb = 0;
		$this->maxRunningThreadNb = 0;
	}

	/**
	 * @return string
	 */
	public function getEventName(): string
	{
		return $this->eventName;
	}

	/**
	 * @param string $eventName
	 * @return PoolEvent
	 */
	public function setEventName(string $eventName): self
	{
		$this->eventName = $eventName;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getThreadNb(): int
	{
		return $this->threadNb;
	}

	/**
	 * @param int $threadNb
	 * @return PoolEvent
	 */
	public function setThreadNb(int $threadNb): self
	{
		$this->threadNb = $threadNb;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getThreadDoneNb(): int
	{
		return $this->threadDoneNb;
	}

	/**
	 * @param int $threadDoneNb
	 * @return PoolEvent
	 */
	public function setThreadDoneNb(int $threadDoneNb): self
	{
		$this->threadDoneNb = $threadDoneNb;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getThreadLeftNb(): int
	{
		return $this->threadLeftNb;
	}

	/**
	 * @param int $threadLeftNb
	 * @return PoolEvent
	 */
	public function setThreadLeftNb(int $threadLeftNb): self
	{
		$this->threadLeftNb = $threadLeftNb;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxRunningThreadNb(): int
	{
		return $this->maxRunningThreadNb;
	}

	/**
	 * @param int $maxRunningThreadNb
	 * @return PoolEvent
	 */
	public function setMaxRunningThreadNb(int $maxRunningThreadNb): self
	{
		$this->maxRunningThreadNb = $maxRunningThreadNb;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getRunningThreadNb(): int
	{
		return $this->runningThreadNb;
	}

	/**
	 * @param int $runningThreadNb
	 * @return PoolEvent
	 */
	public function setRunningThreadNb(int $runningThreadNb): self
	{
		$this->runningThreadNb = $runningThreadNb;

		return $this;
	}

	/**
	 * @return AbstractThread
	 */
	public function getThread(): ?AbstractThread
	{
		return $this->thread;
	}

	/**
	 * @param AbstractThread|null $thread
	 * @return $this
	 */
	public function setThread(AbstractThread $thread = null): self
	{
		$this->thread = $thread;

		return $this;
	}

}
