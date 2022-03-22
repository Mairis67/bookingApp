<?php

namespace App\Controllers;

use App\Database;
use App\Models\Apartment;
use App\Models\Reservation;
use App\Redirect;
use App\View;
use Carbon\Carbon;

class ReservationsController
{
    public function reservation(array $vars): View
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
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentQuery['available_from'],
            $apartmentQuery['available_to'],
            $apartmentQuery['id'],
            $apartmentQuery['user_id'],
        );

        $reservationQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('reservations')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        $reservation = new Reservation(
            $reservationQuery['reserve_from'],
            $reservationQuery['reserve_to'],
            $reservationQuery['apartment_id'],
            $reservationQuery['user_id'],
            $reservationQuery['id'],
        );

        $userName = $_SESSION['username'];
        $userId = (int) $_SESSION['userid'];

        return new View('Apartments/reservation', [
            'reservation' => $reservation,
            'apartment' => $apartment,
            'username' => $userName,
            'userid' => $userId
        ]);
    }

    public function confirm(array $vars): Redirect
    {

        Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('reservations')
            ->andWhere('apartment_id = :id')
            ->setParameter('id', (int) $vars['id'])
            ->executeQuery()
            ->fetchAllAssociative();

        $userId = (int) $_SESSION['userid'];
        $reserveFrom = $_POST['reserve_from'];
        $reserveTo = $_POST['reserve_to'];

        Database::connection()
            ->insert('reservations', [
                'apartment_id' => (int) $vars['id'],
                'user_id' => $userId,
                'reserve_from' => $reserveFrom,
                'reserve_to' => $reserveTo
            ]);

        $_SESSION['reservationConfirmed'] = 'reserved';
        var_dump($_SESSION['reservationConfirmed']);

        return new Redirect('/apartments/' . $vars['id'] . '/reservation');
    }
}