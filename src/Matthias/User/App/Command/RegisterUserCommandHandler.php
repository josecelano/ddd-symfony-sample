<?php

namespace Matthias\User\App\Command;

use Matthias\User\App\Event\EventProvider;
use Matthias\User\App\Event\UserWasRegisteredEvent;
use Matthias\User\Domain\User;
use SimpleBus\Command\Command;
use SimpleBus\Command\Handler\CommandHandler;

class RegisterUserCommandHandler implements CommandHandler
{
    /**
     * @var EventProvider
     */
    private $eventProvider;

    public function __construct(
        EventProvider $eventProvider
    ) {
        $this->eventProvider = $eventProvider;
    }

    /**
     * @param Command $command
     * @return void
     */
    public function handle(Command $command)
    {
        // TODO: implement DoctrineUserRepository

        /** @var User $user */
        //$user = $this->userRepository->createUser($command->username, $command->password);

        //$this->userRepository->insert($user);

        // create the event
        //$event = new UserWasRegisteredEvent($user->getUsername());
        $event = new UserWasRegisteredEvent('username');

        $this->eventProvider->raise($event);
    }
}