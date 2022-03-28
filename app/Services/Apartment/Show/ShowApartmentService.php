<?php

namespace App\Services\Apartment\Show;


use App\Models\Apartment;
use App\Repositories\Apartment\ApartmentRepository;
use App\Repositories\Apartment\MySqlApartmentRepository;

class ShowApartmentService
{
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new MySqlApartmentRepository();
    }

    public function execute(ShowApartmentRequest $request): Apartment
    {
        $apartmentId = $request->getApartmentId();

        return $this->apartmentRepository->show($apartmentId);
    }
}
