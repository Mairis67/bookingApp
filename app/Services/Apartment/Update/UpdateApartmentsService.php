<?php

namespace App\Services\Apartment\Update;

use App\Models\Apartment;
use App\Repositories\Apartment\ApartmentRepository;
use App\Repositories\Apartment\MySqlApartmentRepository;

class UpdateApartmentsService
{
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new MySqlApartmentRepository();
    }

    public function execute(UpdateApartmentsRequest $request): void
    {

        $apartment = new Apartment(
            $request->getName(),
            $request->getDescription(),
            $request->getAddress(),
            $request->getAvailableFrom(),
            $request->getAvailableTo(),
            $request->getApartmentId(),
        );

        $this->apartmentRepository->update($apartment);
    }
}