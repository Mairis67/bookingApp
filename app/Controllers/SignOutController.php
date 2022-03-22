<?php

namespace App\Controllers;

use App\View;

class SignOutController
{
    function signOut(): View
    {
        session_unset();
        session_destroy();
        return new View('Users/signout');
    }
}