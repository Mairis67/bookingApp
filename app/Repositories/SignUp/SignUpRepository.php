<?php

namespace App\Repositories\SignUp;

interface SignUpRepository
{
    public function signUp(string $email, string $password, string $name, string $surname): void;
}