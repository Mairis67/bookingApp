<?php

namespace App\Services\Reservations\ConfirmReservation;

class ConfirmReservationRequest
{

    private string $reservationFrom;
    private string $reservationTo;
    private int $userId;
    private int $apartmentId;

    public function __construct(string $reservationFrom, string $reservationTo, int $userId, int $apartmentId)
    {
        $this->reservationFrom = $reservationFrom;
        $this->reservationTo = $reservationTo;
        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
    }

    public function getReservationFrom(): string
    {
        return $this->reservationFrom;
    }

    public function getReservationTo(): string
    {
        return $this->reservationTo;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }
}