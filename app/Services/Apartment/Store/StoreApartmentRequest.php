<?php

namespace App\Services\Apartment\Store;

class StoreApartmentRequest
{
    private string $name;
    private string $description;
    private string $address;
    private string $availableFrom;
    private string $availableTo;
    private int $userId;

    public function __construct(string $name, string $description, string $address, string $availableFrom,
                                string $availableTo, int $userId)
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->availableFrom = $availableFrom;
        $this->availableTo = $availableTo;
        $this->userId = $userId;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

}