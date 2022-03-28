<?php

namespace App\Controllers;

use App\Database;
use App\Models\Reservation;
use App\Redirect;
use App\Services\Apartment\Show\ShowApartmentRequest;
use App\Services\Apartment\Show\ShowApartmentService;
use App\Services\Reservations\ConfirmReservation\ConfirmReservationRequest;
use App\Services\Reservations\ConfirmReservation\ConfrimReservationService;
use App\Services\Reservations\Reservation\ReservationRequest;
use App\Services\Reservations\Reservation\ReservationService;
use App\View;

class ReservationsController
{
    public function reservation(array $vars): View
    {
        $apartmentId = (int) $vars['id'];

        $apartmentService = new ShowApartmentService();

        $apartment = $apartmentService->execute(new ShowApartmentRequest($apartmentId));

        $reservationService = new ReservationService();

        $reservation = $reservationService->execute(new ReservationRequest($apartmentId));

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
        $apartmentId = (int) $vars['id'];

        $userId = (int) $_SESSION['userid'];
        $reserveFrom = $_POST['reserve_from'];
        $reserveTo = $_POST['reserve_to'];

        $service = new ConfrimReservationService();

        $service->execute(new ConfirmReservationRequest($reserveFrom, $reserveTo, $userId, $apartmentId));

        $_SESSION['reservationConfirmed'] = 'reserved';
        var_dump($_SESSION['reservationConfirmed']);

        return new Redirect('/apartments/' . $apartmentId . '/reservation');
    }
}