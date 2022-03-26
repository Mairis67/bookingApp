<?php

namespace App\Services\Apartment\Index;

use App\Database;
use App\Models\Apartment;

class IndexApartmentService
{
    public function execute(): array
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
                $apartmentData['id'],
                $apartmentDate['user_id']
            );
        }
        return $apartments;
    }
}