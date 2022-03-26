<?php

namespace App\Services\Apartment\Update;

use App\Database;

class UpdateApartmentsService
{
    public function execute(UpdateApartmentsRequest $request)
    {
        Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $request->getApartmentId())
            ->executeQuery()
            ->fetchAssociative();

        Database::connection()->update('apartments', [
            'name' => $request->getName(),
            'description' => $request->getDescription(),
            'address' => $request->getAddress(),
            'available_from' => $request->getAvailableFrom(),
            'available_to' => $request->getAvailableTo(),
        ], ['id' => $request->getApartmentId()]);
    }
}