<?php

namespace App\Repositories\Users;

use App\Database;
use App\Models\User;

class MySqlUsersRepository implements UsersRepository
{
    public function index(): array
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
        return $users;
    }

    public function show(int $userId): User
    {
        $usersQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $userId)
            ->executeQuery()
            ->fetchAssociative();

        $userProfileQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_profiles')
            ->where('user_id = ?')
            ->setParameter(0, $userId)
            ->executeQuery()
            ->fetchAssociative();

        return new User(
            $userProfileQuery['name'],
            $userProfileQuery['surname'],
            $usersQuery['email'],
            $usersQuery['password'],
            $usersQuery['id'],
        );
    }

}