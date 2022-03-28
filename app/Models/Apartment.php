<?php

namespace App\Models;

class Apartment
{
    private string $name;
    private string $description;
    private string $address;
    private string $availableFrom;
    private string $availableTo;
    private array $reviews;
    private int $userId;
    private ?int $id;

    public function __construct(string $name, string $description, string $address, string $availableFrom,
                                string $availableTo,  int $userId, ?int $id = null, array $reviews = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->availableFrom = $availableFrom;
        $this->availableTo = $availableTo;
        $this->reviews = $reviews;
        $this->id = $id;
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviews(): array
    {
        return $this->reviews;
    }
}