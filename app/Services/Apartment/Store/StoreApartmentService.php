<?php

namespace App\Services\Apartment\Store;

use App\Database;

class StoreApartmentService
{
    public function execute(StoreApartmentRequest $request)
    {
        Database::connection()
            ->insert('apartments', [
                'name' => $request->getName(),
                'description' => $request->getDescription(),
                'address' => $request->getAddress(),
                'available_from' => $request->getAvailableFrom(),
                'available_to' => $request->getAvailableTo(),
                'user_id' => $request->getUserId()
            ]);
    }
}