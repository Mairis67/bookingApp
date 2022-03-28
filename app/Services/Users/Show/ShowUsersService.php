<?php

namespace App\Services\Users\Show;

use App\Models\User;
use App\Repositories\Users\MySqlUsersRepository;
use App\Repositories\Users\UsersRepository;
use App\Services\Apartment\Show\ShowApartmentRequest;

class ShowUsersService
{
    private UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new MySqlUsersRepository();
    }

    public function execute(ShowUsersRequest $userId): User
    {
        $request = $userId->getUserId();

        return $this->usersRepository->show($request);
    }

}