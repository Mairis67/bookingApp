<?php

namespace App\Services\Apartment\Delete;

use App\Database;

class DeleteApartmentService
{
    public function execute(DeleteApartmentRequest $request)
    {
        Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $request->getApartmentId())
            ->executeQuery()
            ->fetchAssociative();

        Database::connection()
            ->delete('apartments', ['id' => $request->getApartmentId()]);
    }
}