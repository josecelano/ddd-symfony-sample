<?php

namespace Matthias\Common\App\Event;

use Matthias\Common\App\Event\IsHandledAsynchronously;
use SimpleBus\Message\Message;

class IsHandleAsynchronouslySampleEvent implements Message, IsHandledAsynchronously
{
    /**
     * @var integer
     */
    private $eventId;

    /**
     * @param $eventId
     */
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}