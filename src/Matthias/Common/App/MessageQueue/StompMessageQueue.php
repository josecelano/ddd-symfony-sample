<?php

namespace Matthias\Common\App\MessageQueue;

use Matthias\Common\App\Serializer\SerializerInterface;
use SimpleBus\Message\Message;
use FuseSource\Stomp\Stomp;

class StompMessageQueue implements MessageQueue
{
    private $host;
    private $port;
    private $queueName;
    private $user;
    private $password;


    private $stomp;

    /**
     * @var SerializerInterface
     */
    private $serializer;


    public function __construct(
        $host,
        $port,
        $queueName,
        $user,
        $password,
        SerializerInterface $serializer)
    {
        $this->host = $host;
        $this->port = $port;
        $this->queueName = $queueName;
        $this->user = $user;
        $this->password = $password;
        $this->serializer = $serializer;
        $this->stomp = new Stomp('tcp://'.$this->host.':'.$this->port);

        /* connection */
        try {
            $this->stomp->connect($this->user, $this->password);
        } catch(\StompException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * @param Message $message
     */
    public function publish(Message $message)
    {
        $properties = array(
            'origin-class-path' => get_class($message)
        );
        $body = $this->serializer->serialize($message, 'json');

        $this->stomp->send($this->queueName, $body, $properties);
    }

    /**
     * @return Message $message
     */
    public function consume()
    {
        /* subscribe to messages from the queue */
        $this->stomp->subscribe($this->queueName);

        $this->stomp->setReadTimeout(2);

        /* read a frame */
        $frame = $this->stomp->readFrame();

        if ( $frame != null) {

            if (isset($frame->headers['origin-class-path'])) {

                $message = $this->serializer->deserialize($frame->body, $frame->headers['origin-class-path'], 'json');

                // acknowledge that the frame was received
                $this->stomp->ack($frame);

                return $message;
            }
        }

        // Nothing to consume (no messages in the queue or no messages with origin-class-path header)
        return null;
    }
}