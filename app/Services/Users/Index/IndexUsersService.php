<?php

namespace App\Services\Users\Index;

use App\Repositories\Users\MySqlUsersRepository;
use App\Repositories\Users\UsersRepository;

class IndexUsersService
{
    private UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new MySqlUsersRepository();
    }

    public function execute(): array
    {
        $request = $this->usersRepository->index();

        $users = new IndexUsersRequest($request);

        return $users->getUsers();
    }

}