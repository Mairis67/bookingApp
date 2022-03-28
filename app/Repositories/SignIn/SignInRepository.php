<?php

namespace App\Repositories\SignIn;

interface SignInRepository
{
    public function search(string $email);
}