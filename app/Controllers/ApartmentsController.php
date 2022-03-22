<?php

namespace App\Controllers;

use App\Database;
use App\Models\Apartment;
use App\Models\Review;
use App\Redirect;
use App\View;
use Carbon\Carbon;

class ApartmentsController
{
    public function index(): View
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
//            ->orderBy('id', 'desc')
            ->executeQuery()
            ->fetchAllAssociative();

        $apartments = [];

        foreach ($apartmentQuery as $apartmentData) {
            $apartmentDate = explode(' ',$apartmentData['available_from']);
            $apartments [] = new Apartment(
                $apartmentData['name'],
                $apartmentData['description'],
                $apartmentData['address'],
                $apartmentDate[0],
                $apartmentData['available_to'],
                $apartmentData['id'],
                $apartmentDate['user_id']
            );
        }

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Apartments/index', [
            'apartments' => $apartments,
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function show(array $vars): View
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        $apartmentDate = explode(' ', $apartmentQuery['available_from']);

        $apartment = new Apartment(
            $apartmentQuery['name'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentDate[0],
            $apartmentQuery['available_to'],
            $apartmentQuery['id'],
            $apartmentQuery['user_id']
        );

        $reviewsQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartment_reviews')
            ->where('apartment_id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAllAssociative();

        $reviews = [];

        foreach ($reviewsQuery as $reviewData) {
            $reviews [] = new Review(
                $reviewData['author'],
                $reviewData['review'],
                $reviewData['created_at'],
                $reviewData['author_id'],
                $reviewData['apartment_id'],
                $reviewData['id'],
            );
        }

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Apartments/show', [
            'apartment' => $apartment,
            'reviews' => $reviews,
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function create(): View
    {
        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Apartments/create', [
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function store(): Redirect
    {
        $date = Carbon::now();

        if(empty($_POST['available_from'])) {
            $availableFrom = $date->toDateString();
        } else {
            $availableFrom = $_POST['available_from'];
        }

        $month = $date->endOfMonth()->toDateString();

        if(empty($_POST['available_to'])) {
            $availableTo = $month;
        } else {
            $availableTo = $_POST['available_to'];
        }

        $userId = $_SESSION['userid'];

        Database::connection()
            ->insert('apartments', [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'address' => $_POST['address'],
                'available_from' => $availableFrom,
                'available_to' => $availableTo,
                'user_id' => $userId
            ]);

        return new Redirect('/apartments');
    }

    public function delete(array $vars): Redirect
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        if($_SESSION['userid'] === $apartmentQuery['user_id']) {
            Database::connection()
                ->delete('apartments', ['id' => (int) $vars['id']]);
        }

        return new Redirect('/apartments');
    }

    public function edit(array $vars): View
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        $apartment = new Apartment(
            $apartmentQuery['name'],
            $apartmentQuery['address'],
            $apartmentQuery['description'],
            $apartmentQuery['available_from'],
            $apartmentQuery['available_to'],
            $apartmentQuery['id'],
            $apartmentQuery['user_id']
        );

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Apartments/edit', [
            'apartment' => $apartment,
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function update(array $vars): Redirect
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        if($_SESSION['userid'] === $apartmentQuery['user_id']) {
            Database::connection()->update('apartments', [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'address' => $_POST['address'],
                'available_from' => $_POST['available_from'],
                'available_to' => $_POST['available_to'],
            ], ['id' => (int) $vars['id']]);
        }

        return new Redirect('/apartments/' . $vars['id']);
    }


}