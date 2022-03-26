<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\SignUp\SignUpUserRequest;
use App\Services\SignUp\SignUpUserService;
use App\View;

class SignUpController
{
    public function signup(): View
    {
        return new View('Users/signup');
    }

    public function signupUser(): Redirect
    {
        $service = new SignUpUserService();
        $service->execute(new SignUpUserRequest($_POST['name'],$_POST['surname'] ,$_POST['email'], $_POST['password']));

        return new Redirect('/');
    }
}