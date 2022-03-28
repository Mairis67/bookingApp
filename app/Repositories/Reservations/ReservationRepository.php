<?php

namespace App\Repositories\Reservations;

use App\Models\Reservation;

interface ReservationRepository
{
    public function reservation(int $apartmentId): Reservation;

    public function confirm(string $reservationFrom, string $reservationTo, int $userId, int $apartmentId);
}