<?php

namespace Matthias\User\App\Event;

use SimpleBus\Message\Type\Event;

class UserWasRegisteredEvent implements Event
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @param integer $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }
}