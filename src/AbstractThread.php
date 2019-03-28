<?php

namespace Wonderland\Thread;

use Wonderland\Thread\Exception\ThreadException;

abstract class AbstractThread extends AbstractThreadMediator
{
	const EXIT_STATUS_SUCCESS = 0;
	const EXIT_STATUS_ERROR = 1;

	/** @var int $pid */
	private $pid;

	/** @var string $processName */
	private $processName;

    /**
     * AbstractThread constructor.
     *
     * @param string $processName
     */
	public function __construct(string $processName)
    {
        $this->processName = $processName;
    }

    /**
     * Return the name of the method to process during the thread
     * @return string
     */
	abstract protected function getMethodName(): string;

    /**
     * Return the list of dependencies that will be passed as parameters of the method referenced by getMethodName
     * @return array
     */
	abstract protected function getDependencies(): array;

	/**
	 * @return int|null
	 */
	public function getPid(): ?int
	{
		return $this->pid;
	}

	/**
	 * @param int $pid
	 * @return AbstractThread
	 */
	public function setPid(int $pid): self
	{
		$this->pid = $pid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getProcessName(): ?string
	{
		return $this->processName;
	}

	/**
	 * @return int
	 * @throws ThreadException
	 */
	public function run(): int
	{
		if (false === method_exists($this, $this->getMethodName())) {
			throw new ThreadException('No proper method defined for the thread');
		}

		$status = call_user_func_array(
            [$this, $this->getMethodName()],
            array_merge([$this->getProcessName()], $this->getDependencies())
        );

		if (null === $status) {
			throw new ThreadException('Error. You must return a process status in ' . get_class($this) . ":" . $this->getMethodName());
		}

		return $status;
	}

}
