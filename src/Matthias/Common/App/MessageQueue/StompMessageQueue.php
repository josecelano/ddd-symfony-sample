<?php

namespace Matthias\Common\App\MessageQueue;

use SimpleBus\Message\Message;

class StompMessageQueue implements MessageQueue
{
    private $host;
    private $port;
    private $queueName;
    private $user;
    private $password;
    private $stomp;

    public function __construct($host, $port, $queueName, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->queueName = $queueName;
        $this->user = $user;
        $this->password = $password;

        /* connection */
        try {
            $this->stomp = new \Stomp($this->host.':'.$this->port, $this->user, $this->password);
        } catch(\StompException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * @param Message $message
     */
    public function send(Message $message)
    {
        // TODO: format message
        $this->stomp->send($this->queueName, 'TEST');
    }
}