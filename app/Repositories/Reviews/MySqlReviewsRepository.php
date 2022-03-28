<?php

namespace App\Repositories\Reviews;

use App\Database;
use App\Models\Review;

class MySqlReviewsRepository implements ReviewsRepository
{
    public function getReviews(int $apartmentId): array
    {
        $reviewQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartment_reviews')
            ->where('apartment_id =?')
            ->setParameter(0, $apartmentId)
            ->orderBy('created_at', 'desc')
            ->executeQuery()
            ->fetchAllAssociative();

        $reviews = [];
        foreach ($reviewQuery as $item) {
            $reviews[] = new Review(
                $item['author'],
                $item['review'],
                $item['created_at'],
                $item['author_id'],
                $item['apartment_id'],
                $item['id']
            );
        }
        return $reviews;
    }

    public function storeReviews(string $author, string $review, int $authorId, int $apartmentId): void
    {
        Database::connection()
            ->insert('apartment_reviews', [
                'author' => $author,
                'review' => $review,
                'author_id' => $authorId,
                'apartment_id' => $apartmentId
            ]);
    }

    public function delete(int $id): void
    {
        Database::connection()
            ->delete('apartment_reviews', ['id' => $id]);
    }
}