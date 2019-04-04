<?php

namespace Wonderland\Thread\Example\Simple;


use Wonderland\Thread\Mediator\Event\EventInterface;

class TestEvent implements EventInterface
{
    const EVENT_NAME = 'THREAD_TEST';

    /**
     * @var string
     */
    private $eventParam;

    /**
     * TestEvent constructor.
     *
     * @param $param
     */
    public function __construct($param)
    {
        $this->eventParam = $param;
    }

    /**
     * @return mixed
     */
    public function getEventParam()
    {
        return $this->eventParam;
    }

    /**
     * @param mixed $eventParam
     * @return TestEvent
     */
    public function setEventParam($eventParam)
    {
        $this->eventParam = $eventParam;

        return $this;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }


}