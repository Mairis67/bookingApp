<?php

namespace App\Services\Apartment\Store;

use App\Models\Apartment;
use App\Repositories\Apartment\MySqlApartmentRepository;
use App\Repositories\Apartment\ApartmentRepository;

class StoreApartmentService
{

    private ApartmentRepository $storeApartmentRepository;

    public function __construct()
    {
        $this->storeApartmentRepository = new MySqlApartmentRepository();
    }

    public function execute(StoreApartmentRequest $request): Apartment
    {
        $apartment = new Apartment(
            $request->getName(),
            $request->getDescription(),
            $request->getAddress(),
            $request->getAvailableFrom(),
            $request->getAvailableTo(),
            $request->getUserId()
        );

        $this->storeApartmentRepository->store($apartment);

        return $apartment;
    }
}