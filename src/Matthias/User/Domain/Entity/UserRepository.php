<?php

namespace Matthias\User\Domain\Entity;

use Matthias\User\Domain\User;

interface UserRepository
{
    /**
     * @param $username
     * @return User
     */
    public function findByUsername($username);

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user);
}