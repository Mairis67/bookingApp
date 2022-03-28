<?php

namespace App\Services\Apartment\Delete;

use App\Repositories\Apartment\ApartmentRepository;
use App\Repositories\Apartment\MySqlApartmentRepository;

class DeleteApartmentService
{
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new MySqlApartmentRepository();
    }

    public function execute(DeleteApartmentRequest $request)
    {
        $this->apartmentRepository->delete($request->getApartmentId());
    }
}