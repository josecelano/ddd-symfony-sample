<?php

namespace Matthias\Common\App\Event;

use SimpleBus\Message\Subscriber\MessageSubscriber;
use SimpleBus\Message\Message;

class IsHandleAsynchronouslySampleEventHandler implements MessageSubscriber
{
    /*public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
        //$this->userMailer = $userMailer;
    }*/

    /**
     * @param Message $message
     */
    public function notify(Message $message)
    {
        // TODO: do something

        // DEBUG
        var_dump($message);

    }
}