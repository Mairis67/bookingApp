<?php

namespace App\Services\Apartment\Edit;

use App\Database;
use App\Models\Apartment;
use App\Repositories\Apartment\ApartmentRepository;
use App\Repositories\Apartment\MySqlApartmentRepository;

class EditApartmentService
{
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new MySqlApartmentRepository();
    }

    public function execute(EditApartmentRequest $request): Apartment
    {
        $apartmentId = $request->getApartmentId();

        return $this->apartmentRepository->edit($apartmentId);
    }

}