<?php

namespace App\Services\Reservations\Reservation;


use App\Models\Reservation;
use App\Repositories\Reservations\MySqlReservationRepository;
use App\Repositories\Reservations\ReservationRepository;

class ReservationService
{
    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new MySqlReservationRepository();
    }

    public function execute(ReservationRequest $request): Reservation
    {
        $apartmentId = $request->getApartmentId();

        return $this->reservationRepository->reservation($apartmentId);
    }

}