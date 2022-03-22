<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\View;

class SignUpController
{
    public function signup(): View
    {
        return new View('Users/signup');
    }

    public function signupUser(): Redirect
    {
        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('email')
            ->from('users')
            ->where("email = '{$_POST['email']}'")
            ->executeQuery()
            ->fetchAssociative();

        if($usersQuery !== false) {
            return new Redirect('/users/signup');
        }

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        Database::connection()
            ->insert('users', [
                'email' => $_POST['email'],
                'password' => $hashedPassword
            ]);

        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('email', 'id')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $_POST['email'])
            ->executeQuery()
            ->fetchAssociative();

        $userId = $usersQuery['id'];

        Database::connection()
            ->insert('user_profiles', [
                'user_id' => $userId,
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
            ]);

        return new Redirect('/');
    }
}