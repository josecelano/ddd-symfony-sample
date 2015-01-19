<?php

namespace Matthias\Common\App\MessageQueue;
use SimpleBus\Message\Message;

/**
 * Marker interface for commands that should be handled asynchronously
 */
interface MessageQueue
{
    /**
     * @param Message $message
     */
    public function send(Message $message);
}