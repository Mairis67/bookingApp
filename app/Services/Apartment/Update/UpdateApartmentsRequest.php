<?php

namespace App\Services\Apartment\Update;

class UpdateApartmentsRequest
{
    private string $name;
    private string $description;
    private string $address;
    private string $availableFrom;
    private string $availableTo;
    private int $apartmentId;

    public function __construct(string $name, string $description, string $address, string $availableFrom,
                                string $availableTo, int $apartmentId)
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->availableFrom = $availableFrom;
        $this->availableTo = $availableTo;
        $this->apartmentId = $apartmentId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAvailableFrom(): string
    {
        return $this->availableFrom;
    }

    public function getAvailableTo(): string
    {
        return $this->availableTo;
    }

    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }

}