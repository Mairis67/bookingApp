<?php

namespace App\Repositories\SignUp;

use App\Database;

class MySqlSignUpRepository implements SignUpRepository
{
    public function signUp($email, $password, $name, $surname): void
    {
        Database::connection()
            ->createQueryBuilder()
            ->select('email')
            ->from('users')
            ->where("email = '$email'")
            ->executeQuery()
            ->fetchAssociative();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        Database::connection()
            ->insert('users', [
                'email' => $email,
                'password' => $hashedPassword
            ]);

        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('email', 'id')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $email)
            ->executeQuery()
            ->fetchAssociative();

        $userId = $usersQuery['id'];

        Database::connection()
            ->insert('user_profiles', [
                'user_id' => $userId,
                'name' => $name,
                'surname' => $surname,
            ]);
    }

}