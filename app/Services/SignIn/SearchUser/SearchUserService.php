<?php

namespace App\Services\SignIn\SearchUser;

use App\Repositories\SignIn\MySqlSignInRepository;
use App\Repositories\SignIn\SignInRepository;

class SearchUserService
{
    private SignInRepository $signInRepository;

    public function __construct()
    {
        $this->signInRepository = new MySqlSignInRepository();
    }

    public function execute(SearchUserRequest $request)
    {
        $email = $request->getEmail();

        return $this->signInRepository->search($email);
    }
}