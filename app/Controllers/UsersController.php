<?php

namespace App\Controllers;

use App\Database;
use App\Models\User;
use App\View;

class UsersController
{
    public function index(): View
    {
        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->executeQuery()
            ->fetchAllAssociative();

        $userProfileQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_profiles')
            ->executeQuery()
            ->fetchAllAssociative();

        $users = [];

        foreach ($usersQuery as $userData) {
            foreach ($userProfileQuery as $userProfileData) {
                if ($userData['id'] === $userProfileData['user_id']) {
                    $users[] = new User(
                        $userProfileData['name'],
                        $userProfileData['surname'],
                        $userData['email'],
                        $userData['password'],
                        $userData['id'],
                    );
                }
            }
        }
        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Users/index', [
            'users' => $users,
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function show(array $vars): View
    {
        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        $userProfileQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_profiles')
            ->where('user_id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        $user = new User(
            $userProfileQuery['name'],
            $userProfileQuery['surname'],
            $usersQuery['email'],
            $usersQuery['password'],
            $usersQuery['id'],
        );

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Users/show', [
            'user' => $user,
            'username' => $userName,
            'userid' => $userId
        ]);
    }
}