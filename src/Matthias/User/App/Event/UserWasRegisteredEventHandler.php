<?php

namespace Matthias\User\App\Event;

use Matthias\User\Domain\Entity\UserRepository;
use SimpleBus\Event\Event;
use SimpleBus\Event\Handler\EventHandler;

class UserWasRegisteredEventHandler implements EventHandler
{
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
        //$this->userMailer = $userMailer;
    }

    /**
     * @param Event $event
     */
    public function handle(Event $event)
    {
        // TODO: implement UserMailer

        $user = $this->userRepository->findByUsername($event->getUsername());

        // send email
        // $this->userMailer->sendWelcomeMailTo($user);
    }
}