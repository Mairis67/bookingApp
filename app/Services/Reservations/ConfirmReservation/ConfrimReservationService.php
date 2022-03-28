<?php

namespace App\Services\Reservations\ConfirmReservation;

use App\Repositories\Reservations\MySqlReservationRepository;
use App\Repositories\Reservations\ReservationRepository;

class ConfrimReservationService
{
    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new MySqlReservationRepository();
    }

    public function execute(ConfirmReservationRequest $request)
    {
        $reservationFrom = $request->getReservationFrom();
        $reservationTo = $request->getReservationTo();
        $userId = $request->getUserId();
        $apartmentId = $request->getApartmentId();

        $this->reservationRepository->confirm($reservationFrom, $reservationTo, $userId, $apartmentId);
    }
}