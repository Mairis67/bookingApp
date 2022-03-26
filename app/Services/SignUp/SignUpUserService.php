<?php

namespace App\Services\SignUp;

use App\Database;

class SignUpUserService
{
    public function execute(SignUpUserRequest $request)
    {
        Database::connection()
            ->createQueryBuilder()
            ->select('email')
            ->from('users')
            ->where("email = '{$request->getEmail()}'")
            ->executeQuery()
            ->fetchAssociative();

        $hashedPassword = password_hash($request->getPassword(), PASSWORD_DEFAULT);

        Database::connection()
            ->insert('users', [
                'email' => $request->getEmail(),
                'password' => $hashedPassword
            ]);

        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('email', 'id')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $request->getEmail())
            ->executeQuery()
            ->fetchAssociative();

        $userId = $usersQuery['id'];

        Database::connection()
            ->insert('user_profiles', [
                'user_id' => $userId,
                'name' => $request->getName(),
                'surname' => $request->getSurname(),
            ]);
    }

}