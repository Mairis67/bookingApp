<?php

namespace App\Services\Apartment\Edit;

use App\Database;
use App\Models\Apartment;

class EditApartmentService
{
    public function execute(EditApartmentRequest $request): Apartment
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $request->getApartmentId())
            ->executeQuery()
            ->fetchAssociative();

        return new Apartment(
            $apartmentQuery['name'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentQuery['available_from'],
            $apartmentQuery['available_to'],
            $apartmentQuery['id'],
            $apartmentQuery['user_id']
        );
    }

}