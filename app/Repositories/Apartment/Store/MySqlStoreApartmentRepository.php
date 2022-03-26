<?php

namespace App\Repositories\Apartment\Store;

use App\Database;
use App\Models\Apartment;

class MySqlStoreApartmentRepository implements StoreApartmentRepository
{
    public function save(Apartment $apartment): void
    {
        Database::connection()
            ->insert('apartments', [
                'name' => $apartment->getName(),
                'description' => $apartment->getDescription(),
                'address' => $apartment->getAddress(),
                'available_from' => $apartment->getAvailableFrom(),
                'available_to' => $apartment->getAvailableTo(),
                'user_id' => $apartment->getUserId(),
            ]);
    }

//    public function getById(int $id): Apartment
//    {
//        $apartmentQuery = Database::connection()
//            ->createQueryBuilder()
//            ->select('*')
//            ->from('apartments')
//            ->where("id = $id")
//            ->executeQuery()
//            ->fetchAssociative();
//
//        return $apartmentQuery;
//
//         select * from apartments where id = $id
//         build apartment model
//         return
//    }
}