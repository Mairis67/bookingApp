<?php

namespace App\Services\Apartment\Store;

use App\Models\Apartment;
use App\Repositories\Apartment\Store\MySqlStoreApartmentRepository;
use App\Repositories\Apartment\Store\StoreApartmentRepository;

class StoreApartmentService
{

    private StoreApartmentRepository $storeApartmentRepository;

    public function __construct()
    {
        $this->storeApartmentRepository = new MySqlStoreApartmentRepository();
    }

    public function execute(StoreApartmentRequest $request): Apartment
    {
        $apartment = new Apartment(
            $request->getName(),
            $request->getDescription(),
            $request->getAddress(),
            $request->getAvailableFrom(),
            $request->getAvailableTo(),
            $request->getUserId(),
        
        );

        $this->storeApartmentRepository->save($apartment);

        return $apartment;
    }
}