<?php

namespace Matthias\User\App\Command;

use Matthias\Common\App\Event\EventRecorder;
use Matthias\User\App\Event\UserWasRegisteredEvent;
use Matthias\User\Domain\User;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class RegisterUserCommandHandler implements MessageHandler
{
    /**
     * @var EventRecorder
     */
    private $eventRecorder;

    public function __construct(
        EventRecorder $eventRecorder
    ) {
        $this->eventRecorder = $eventRecorder;
    }

    /**
     * @param Command|Message $command
     */
    public function handle(Message $command)
    {
        // TODO: implement DoctrineUserRepository

        /** @var User $user */
        //$user = $this->userRepository->createUser($command->username, $command->password);

        //$this->userRepository->insert($user);

        // create the event
        //$event = new UserWasRegisteredEvent($user->getUsername());
        $event = new UserWasRegisteredEvent('username');

        $this->eventRecorder->record($event);
    }
}