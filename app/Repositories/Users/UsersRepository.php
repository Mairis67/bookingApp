<?php

namespace App\Repositories\Users;

use App\Models\User;

interface UsersRepository
{
    public function index(): array;

    public function show(int $userId): User;
}