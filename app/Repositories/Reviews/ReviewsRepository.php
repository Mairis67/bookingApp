<?php

namespace App\Repositories\Reviews;

interface ReviewsRepository
{
    public function getReviews(int $apartmentId): array;

    public function storeReviews(string $author, string $review, int $authorId, int $apartmentId): void;

    public function delete(int $id): void;
}