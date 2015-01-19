<?php

namespace Matthias\User\App\Command;

use Matthias\Common\App\Event\IsHandleAsynchronouslySampleEvent;
use Matthias\User\App\Event\UserWasRegisteredEvent;
use Matthias\User\Domain\User;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use SimpleBus\Message\Recorder\RecordsMessages;

class RegisterUserCommandHandler implements MessageHandler
{
    /**
     * @var RecordsMessages
     */
    private $recordsMessages;

    public function __construct(
        RecordsMessages $recordsMessages
    ) {
        $this->recordsMessages = $recordsMessages;
    }

    /**
     * @param Message $command
     */
    public function handle(Message $command)
    {
        // TODO: implement DoctrineUserRepository

        /** @var User $user */
        //$user = $this->userRepository->createUser($command->username, $command->password);

        //$this->userRepository->insert($user);

        // create the event
        //$event = new UserWasRegisteredEvent($user->getUsername());
        $userWasRegisteredEvent = new UserWasRegisteredEvent('username');

        $this->recordsMessages->record($userWasRegisteredEvent);

        // create new event to be handle asynchronously
        $eventId = 11111;
        $isHandleAsynchronouslySampleEvent = new IsHandleAsynchronouslySampleEvent($eventId);

        $this->recordsMessages->record($isHandleAsynchronouslySampleEvent);
    }
}