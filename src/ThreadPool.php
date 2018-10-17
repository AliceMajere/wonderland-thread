<?php

namespace Wonderland\Thread;

use Wonderland\Thread\Event\Event;
use Wonderland\Thread\Exception\ThreadException;

class ThreadPool extends AbstractThreadPoolMediator
{
	// 0.2s
	private const SLEEP_TIME_MS = 50000;

	/** @var Thread[] $childs */
	private $threads;

	/** @var Thread[] $toRunThreads */
	private $toRunThreads;

	/** @var Thread[] $runningChilds */
	private $runningThreads;

	/** @var bool $isRunning */
	private $isRunning;

	/** @var int $maxRunningThreadNb */
	private $maxRunningThreadNb;

	/**
	 * ThreadPool constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->threads = [];
		$this->runningThreads = [];
		$this->toRunThreads = [];
		$this->isRunning = false;
		$this->maxRunningThreadNb = 0;
	}

	/**
	 *
	 */
	public function __destruct()
	{
		pcntl_waitpid(-1, $status, WNOHANG);
	}

	/**
	 * @return Thread[]
	 */
	public function getThreads(): array
	{
		return $this->threads;
	}

	/**
	 * @param Thread[] $threads
	 * @return ThreadPool
	 * @throws ThreadException
	 */
	public function setThreads(array $threads): self
	{
		if (true === $this->isRunning) {
			throw new ThreadException('Error. The pool is running, the list of thread in the pool is locked.');
		}

		$this->threads = $threads;

		return $this;
	}

	/**
	 * @param Thread $thread
	 * @return ThreadPool
	 * @throws ThreadException
	 */
	public function addThread(Thread $thread): self
	{
		if (null === $thread) {
			throw new ThreadException('The parameter need to be an instance of ' . Thread::class);
		}

		$this->threads = array_merge($this->threads, [$thread]);

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
	 * @return ThreadPool
	 */
	public function setMaxRunningThreadNb(int $maxRunningThreadNb): self
	{
		$this->maxRunningThreadNb = $maxRunningThreadNb;

		return $this;
	}

	/**
	 * @return Thread[]
	 */
	public function getToRunThreads(): array
	{
		return $this->toRunThreads;
	}

	/**
	 * @return Thread[]
	 */
	public function getRunningThreads(): array
	{
		return $this->runningThreads;
	}

	/**
	 * @throws ThreadException
	 */
	public function run()
	{
		$this->checkEnv();
		$this->initRun();

		while ($this->isRunningThreads()) {
			$this->waitOnThreads();
		}

		$this->resetRun();
	}

	/**
	 * @return bool
	 * @throws ThreadException
	 */
	private function isRunningThreads(): bool
	{
		if (count($this->toRunThreads) > 0) {
			while (count($this->runningThreads) < $this->maxRunningThreadNb && count($this->toRunThreads) > 0) {
				$this->createThreadProcess(array_shift($this->toRunThreads));
			}
		}

		return count($this->runningThreads) > 0;
	}

	/**
	 * @param Thread $thread
	 * @throws ThreadException
	 */
	private function createThreadProcess(Thread $thread)
	{
		$pid = pcntl_fork();

		switch ($pid) {
			case -1: //error forking
				throw new ThreadException('Error while trying to fork. Check your server installation');
			case 0: // child
				$this->processThread($thread);
				break;
			default: //parent
				$thread->setPid($pid);
				$this->runningThreads[] = $thread;
				$this->notify(Event::POOL_NEW_THREAD, $thread);
				$this->startRunStatus();
		}
	}

	/**
	 *
	 */
	private function waitOnThreads()
	{
		$this->notify(Event::POOL_PRE_WAIT_TIC);
		foreach ($this->runningThreads as $k => $thread) {

			$res = pcntl_waitpid($thread->getPid(), $status, WNOHANG);
			$this->notify(Event::POOL_WAIT_TIC_PID);

			if ($res === -1 || $res > 0) {
				$this->notify(Event::POOL_WAIT_TIC_PID_REMOVED, $thread);
				unset($this->runningThreads[$k]);
			}

		}
		$this->notify(Event::POOL_POST_WAIT_TIC);

		usleep(self::SLEEP_TIME_MS);
	}

	/**
	 * @param Thread $thread
	 * @throws ThreadException
	 */
	private function processThread(Thread $thread)
	{
		$this->notify(Event::THREAD_PRE_PROCESS, $thread);
		$response = $thread->run($thread->getProcessName());
		$this->notify(Event::THREAD_POST_PROCESS, $thread);

		switch ($response) {
			case Thread::EXIT_STATUS_SUCCESS:
				$this->notify(Event::THREAD_EXIT_SUCCESS, $thread);
				break;
			case Thread::EXIT_STATUS_ERROR:
				$this->notify(Event::THREAD_EXIT_ERROR, $thread);
				break;
			default:
				$this->notify(Event::THREAD_EXIT_UNKNOWN, $thread);
		}

		exit($response);
	}

	/**
	 * @throws ThreadException
	 */
	private function checkEnv()
	{
		if (false === $this->isCli()) {
			throw new ThreadException('Error. It is not safe to use process forking in other way than php-cli');
		}
		if (0 === count($this->threads)) {
			throw new ThreadException('Error. Can\'t run child threads processes without any added in the Pool');
		}
	}

	/**
	 *
	 */
	private function initRun()
	{
		$this->resetRun();

		if (null === $this->maxRunningThreadNb) {
			$this->maxRunningThreadNb = count($this->threads);
		}
	}

	/**
	 * @return bool
	 */
	private function isCli(): bool
	{
		return PHP_SAPI === 'cli';
	}

	/**
	 *
	 */
	private function startRunStatus()
	{
		if (false === $this->isRunning) {
			$this->notify(Event::POOL_RUN_START);
			$this->isRunning = true;
		}
	}

	/**
	 *
	 */
	private function resetRun()
	{
		if (true === $this->isRunning) {
			$this->notify(Event::POOL_RUN_STOP);
		}
		$this->isRunning = false;
		$this->toRunThreads = $this->threads;
		$this->runningThreads = [];
	}

}
