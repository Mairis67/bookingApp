<?php

namespace App\Models;

class Review
{
    private string $author;
    private string $review;
    private string $createdAt;
    private int $authorId;
    private int $apartmentId;
    private int $id;

    public function __construct(
        string $author,
        string $review,
        string $createdAt,
        int $authorId,
        int $apartmentId,
        int $id
    )
    {
        $this->author = $author;
        $this->review = $review;
        $this->createdAt = $createdAt;
        $this->authorId = $authorId;
        $this->apartmentId = $apartmentId;
        $this->id = $id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }

    public function getId(): int
    {
        return $this->id;
    }
}