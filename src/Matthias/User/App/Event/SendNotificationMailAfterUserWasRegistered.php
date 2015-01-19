<?php

namespace Matthias\User\App\Event;

use SimpleBus\Message\Subscriber\MessageSubscriber;
use SimpleBus\Message\Message;

class SendNotificationMailAfterUserWasRegistered implements MessageSubscriber
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
        // TODO: implement UserMailer

        //$user = $this->userRepository->findByUsername($message->getUsername());

        // send email
        // $this->userMailer->sendWelcomeMailTo($user);
    }
}