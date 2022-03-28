<?php

namespace App\Services\SignUp;

use App\Repositories\SignUp\MySqlSignUpRepository;
use App\Repositories\SignUp\SignUpRepository;

class SignUpUserService
{
    private SignUpRepository $signUpRepository;

    public function __construct()
    {
        $this->signUpRepository = new MySqlSignUpRepository();
    }

    public function execute(SignUpUserRequest $request): void
    {
        $email = $request->getEmail();
        $password = $request->getPassword();
        $name = $request->getName();
        $surname = $request->getSurname();

        $this->signUpRepository->signUp($email, $password, $name, $surname);
    }
}