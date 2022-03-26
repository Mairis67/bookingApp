<?php

namespace App\Controllers;

use App\Database;
use App\Models\Apartment;
use App\Models\Review;
use App\Redirect;
use App\Services\Apartment\Delete\DeleteApartmentRequest;
use App\Services\Apartment\Delete\DeleteApartmentService;
use App\Services\Apartment\Edit\EditApartmentRequest;
use App\Services\Apartment\Edit\EditApartmentService;
use App\Services\Apartment\Show\ShowApartmentRequest;
use App\Services\Apartment\Show\ShowApartmentService;
use App\Services\Apartment\Store\StoreApartmentRequest;
use App\Services\Apartment\Store\StoreApartmentService;
use App\Services\Apartment\Update\UpdateApartmentsRequest;
use App\Services\Apartment\Update\UpdateApartmentsService;
use App\View;
use Carbon\Carbon;

class ApartmentsController
{
    public function index(): View
    {
//        $service = new IndexApartmentService();
//
//        $response = $service->execute(new IndexApartmentRequest($articleId));
////
//        $apartments = $service->execute(new IndexApartmentRequest($apartmentId));

        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
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
        $apartmentId = (int) $vars['id'];

        $service = new ShowApartmentService();

        $apartment = $service->execute(new ShowApartmentRequest($apartmentId));

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Apartments/show', [
            'apartment' => $apartment,
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

        $service = new StoreApartmentService();
        $service->execute(new StoreApartmentRequest(
            $_POST['name'],
            $_POST['description'],
            $_POST['address'],
            $availableFrom,
            $availableTo,
            $userId
        ));

        return new Redirect('/apartments');
    }

    public function delete(array $vars): Redirect
    {
        $apartmentId = (int) $vars['id'];

        $service = new DeleteApartmentService();

        $service->execute(new DeleteApartmentRequest($apartmentId));

        if($_SESSION['userid'] === $service) {
            $service->execute(new DeleteApartmentRequest($apartmentId));
        }

        return new Redirect('/apartments');
    }

    public function edit(array $vars): View
    {
        $apartmentId = (int) $vars['id'];

        $service = new EditApartmentService();

        $apartment = $service->execute(new EditApartmentRequest($apartmentId));

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
//        $apartmentId = (int) $vars['id'];
//
//        $service = new UpdateApartmentsService();
//
//        $service->execute(new UpdateApartmentsRequest(
//            $_POST['name'],
//            $_POST['description'],
//            $_POST['address'],
//            $_POST['available_from'],
//            $_POST['available_to'],
//            $apartmentId
//        ));
//
//
//
////        $apartmentQuery = Database::connection()
////            ->createQueryBuilder()
////            ->select('*')
////            ->from('apartments')
////            ->where('id = ?')
////            ->setParameter(0, $apartmentId)
////            ->executeQuery()
////            ->fetchAssociative();
//
//        if($_SESSION['userid'] === $service['user_id']) {
//            $service->execute(new UpdateApartmentsRequest(
//                $_POST['name'],
//                $_POST['description'],
//                $_POST['address'],
//                $_POST['available_from'],
//                $_POST['available_to'],
//                $apartmentId
//            ));
//        }
//
//        return new Redirect('/apartments/' . $vars['id']);

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