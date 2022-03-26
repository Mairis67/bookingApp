<?php

namespace App\Services\SignIn;

use App\Database;

class SignInService
{
    public function execute(SignInRequest $request): void
    {
        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $request->getEmail())
            ->executeQuery()
            ->fetchAssociative();


        Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_profiles')
            ->where('user_id = ?')
            ->setParameter(0, (int) $usersQuery['id'])
            ->executeQuery()
            ->fetchAssociative();
    }
}