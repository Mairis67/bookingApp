<?php

namespace App\Repositories\SignIn;

use App\Database;

class MySqlSignInRepository implements SignInRepository
{
    public function search($email)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $email)
            ->executeQuery()
            ->fetchAssociative();
    }
}