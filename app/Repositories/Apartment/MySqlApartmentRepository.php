<?php

namespace App\Repositories\Apartment;

use App\Database;
use App\Models\Apartment;
use App\Models\Review;

class MySqlApartmentRepository implements ApartmentRepository
{
    public function store(Apartment $apartment): void
    {
        Database::connection()
            ->insert('apartments', [
                'name' => $apartment->getName(),
                'description' => $apartment->getDescription(),
                'address' => $apartment->getAddress(),
                'available_from' => $apartment->getAvailableFrom(),
                'available_to' => $apartment->getAvailableTo(),
                'user_id' => $apartment->getUserId(),
                'id' => $apartment->getId()
            ]);
    }

    public function getById(int $apartmentId): Apartment
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where("id = $apartmentId")
            ->executeQuery()
            ->fetchAssociative();

        $apartmentDate = explode(' ', $apartmentQuery['available_from']);

        return new Apartment(
            $apartmentQuery['name'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentDate,
            $apartmentQuery['available_to'],
            $apartmentQuery['user_id'],
            $apartmentQuery['id']
        );
    }

    public function index(): array
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->executeQuery()
            ->fetchAllAssociative();

        $apartments = [];

        foreach ($apartmentQuery as $apartmentData) {
            $apartmentDate = explode(' ',$apartmentData['available_from']);
            $apartments [] = new Apartment(
                $apartmentData['name'],
                $apartmentData['description'],
                $apartmentData['address'],
                $apartmentDate[0],
                $apartmentData['available_to'],
                $apartmentData['user_id'],
                $apartmentData['id']
            );
        }
        return $apartments;
    }

    public function delete(int $apartmentId): void
    {
        Database::connection()
            ->delete('apartments', ['id' => $apartmentId]);
    }

    public function edit($apartmentId): Apartment
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $apartmentId)
            ->executeQuery()
            ->fetchAssociative();

        return new Apartment(
            $apartmentQuery['name'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentQuery['available_from'],
            $apartmentQuery['available_to'],
            $apartmentQuery['user_id'],
            $apartmentQuery['id']
        );
    }

    public function show(int $apartmentId): Apartment
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $apartmentId)
            ->executeQuery()
            ->fetchAssociative();

        $apartmentDate = explode(' ', $apartmentQuery['available_from']);

        $reviewsQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartment_reviews')
            ->where('apartment_id = ?')
            ->setParameter(0, $apartmentId)
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
            $apartmentQuery['user_id'],
            $apartmentQuery['id'],
            $reviews
        );
    }

    public function update(Apartment $apartment):void
    {
        Database::connection()->update('apartments', [
            'name' => $apartment->getName(),
            'description' => $apartment->getDescription(),
            'address' => $apartment->getAddress(),
            'available_from' => $apartment->getAvailableFrom(),
            'available_to' => $apartment->getAvailableTo(),
        ], ['id' => $apartment->getUserId()]);
    }
}