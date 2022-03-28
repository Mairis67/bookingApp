<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\Services\SignIn\SearchUser\SearchUserRequest;
use App\Services\SignIn\SearchUser\SearchUserService;
use App\Services\SignIn\SignInUser\SignInRequest;
use App\Services\SignIn\SignInUser\SignInService;
use App\View;

class SignInController
{
    public function signInUser(): View
    {
        return new View('Users/signin');
    }

    public function signIn(): Redirect
    {
        $registeredService = new SearchUserService();

        $usersQuery = $registeredService->execute(new SearchUserRequest($_POST['email']));

        // Wrong email
        if($usersQuery === false) {
            return new Redirect('/users/signin');
        }

        // Wrong password
        if(!password_verify($_POST['password'], $usersQuery['password'])) {
            return  new Redirect('/users/signin');
        }

//        $singInService = new SignInService();
//
//        $usersProfileQuery = $singInService->execute(new SignInRequest($_POST['email']));

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