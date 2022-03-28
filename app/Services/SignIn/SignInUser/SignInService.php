<?php

namespace App\Services\SignIn\SignInUser;

use App\Database;
use App\Models\User;

class SignInService
{
    public function execute(SignInRequest $request)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $request->getEmail())
            ->executeQuery()
            ->fetchAssociative();
    }
}