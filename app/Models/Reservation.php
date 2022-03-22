<?php

namespace App\Models;

class Reservation
{
    private string $reservationFrom;
    private string $reservationTo;
    private int $id;
    private int $userId;
    private int $apartmentId;

    public function __construct(string $reservationFrom, string $reservationTo, int $id, int $userId, int $apartmentId)
    {
        $this->reservationFrom = $reservationFrom;
        $this->reservationTo = $reservationTo;
        $this->id = $id;
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

    public function getId(): int
    {
        return $this->id;
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