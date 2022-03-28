<?php

namespace App\Services\Reviews\Show;

class ShowReviewsResponse
{
    private array $reviews;

    public function __construct(array $reviews)
    {
        $this->reviews = $reviews;
    }

    public function getReviews(): array
    {
        return $this->reviews;
    }
}