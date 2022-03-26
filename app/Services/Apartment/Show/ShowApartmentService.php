<?php

namespace App\Services\Apartment\Show;

use App\Database;
use App\Models\Apartment;
use App\Models\Review;

class ShowApartmentService
{
    public function execute(ShowApartmentRequest $request): Apartment
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $request->getApartmentId())
            ->executeQuery()
            ->fetchAssociative();

        $apartmentDate = explode(' ', $apartmentQuery['available_from']);

        $reviewsQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartment_reviews')
            ->where('apartment_id = ?')
            ->setParameter(0, $request->getApartmentId())
            ->executeQuery()
            ->fetchAllAssociative();

        $reviews = [];

        foreach ($reviewsQuery as $reviewData) {
            $reviews [] = new Review(
                $reviewData['author'],
                $reviewData['review'],
                $reviewData['created_at'],
                $reviewData['author_id'],
                $reviewData['apartment_id'],
                $reviewData['id'],
            );
        }

        return new Apartment(
            $apartmentQuery['name'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentDate[0],
            $apartmentQuery['available_to'],
            $apartmentQuery['id'],
            $apartmentQuery['user_id'],
            $reviews
        );
    }
}
