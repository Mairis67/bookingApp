<?php

namespace App\Models;

class Reservation
{
    private string $reservationFrom;
    private string $reservationTo;
    private int $userId;
    private int $apartmentId;
    private ?int $id;

    public function __construct(string $reservationFrom, string $reservationTo, int $userId, int $apartmentId,
                                int $id = null)
    {
        $this->reservationFrom = $reservationFrom;
        $this->reservationTo = $reservationTo;
        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->id = $id;
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

    public function getId(): ?int
    {
        return $this->id;
    }
}