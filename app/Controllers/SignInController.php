<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\Services\SignIn\SignInRequest;
use App\Services\SignIn\SignInService;
use App\View;

class SignInController
{
    public function signInUser(): View
    {
        return new View('Users/signin');
    }

    public function signIn(): Redirect
    {
        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $_POST['email'])
            ->executeQuery()
            ->fetchAssociative();

        // Wrong email
        if($usersQuery === false) {
            return new Redirect('/users/signin');
        }

        // Wrong password
        if(!password_verify($_POST['password'], $usersQuery['password'])) {
            return  new Redirect('/users/signin');
        }

        $usersProfileQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_profiles')
            ->where('user_id = ?')
            ->setParameter(0, (int) $usersQuery['id'])
            ->executeQuery()
            ->fetchAssociative();

        $_SESSION['userid'] = $usersProfileQuery['id'];
        $_SESSION['username'] = $usersProfileQuery['name'];

        return new Redirect('/users/home');
    }

}