<?php

namespace App\Controllers;

use App\Database;
use App\Models\User;
use App\Services\Users\Index\IndexUsersService;
use App\Services\Users\Show\ShowUsersRequest;
use App\Services\Users\Show\ShowUsersService;
use App\View;

class UsersController
{
    public function index(): View
    {
        $service = new IndexUsersService();

        $users = $service->execute();

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Users/index', [
            'users' => $users,
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function show(array $vars): View
    {
        $userId = (int) $vars['id'];

        $service = new ShowUsersService();

        $user = $service->execute(new ShowUsersRequest($userId));

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Users/show', [
            'user' => $user,
            'username' => $userName,
            'userid' => $userId
        ]);
    }
}