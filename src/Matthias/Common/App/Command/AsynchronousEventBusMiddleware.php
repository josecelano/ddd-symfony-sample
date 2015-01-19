<?php

namespace Matthias\Common\App\Command;

use Matthias\Common\App\MessageQueue\MessageQueue;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Message;

class AsynchronousEventBusMiddleware implements MessageBusMiddleware
{
    /**
     * @var MessageQueue
     */
    private $messageQueue;

    public function __construct(
        MessageQueue $messageQueue
    ) {
        $this->messageQueue = $messageQueue;
    }

    /**
     * The provided $next callable should be called whenever the next middleware should start handling the message.
     * Its only argument should be a Message object (usually the same as the originally provided message).
     *
     * @param Message $message
     * @param callable $next
     * @return void
     */
    public function handle(Message $message, callable $next)
    {
        // do whatever you want

        if (in_array('Matthias\Common\App\Event\IsHandledAsynchronously', class_implements($message))) {

            // handle the message asynchronously using a message queue
            $this->messageQueue->send($message);

        } else {

            // handle the message synchronously, i.e. right-away
            $next($message);
        }

        // maybe do some more things
    }
}