<?php

namespace Matthias\User\App\Event;

use SimpleBus\Event\Event;

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

    /**
     * @return string
     */
    public function name()
    {
        return 'user_was_registered';
    }
}