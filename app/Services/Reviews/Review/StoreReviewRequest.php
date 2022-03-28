<?php

namespace App\Services\Reviews\Review;

class StoreReviewRequest
{
    private string $author;
    private string $review;
    private int $authorId;
    private int $apartmentId;

    public function __construct(string $author, string $review, int $authorId, int $apartmentId)
    {
        $this->author = $author;
        $this->review = $review;
        $this->authorId = $authorId;
        $this->apartmentId = $apartmentId;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }
}