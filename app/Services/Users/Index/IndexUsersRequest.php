<?php

namespace App\Services\Users\Index;

class IndexUsersRequest
{

    private array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}