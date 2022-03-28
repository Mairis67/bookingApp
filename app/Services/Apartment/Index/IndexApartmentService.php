<?php

namespace App\Services\Apartment\Index;

use App\Repositories\Apartment\ApartmentRepository;
use App\Repositories\Apartment\MySqlApartmentRepository;
use function Symfony\Component\Translation\t;

class IndexApartmentService
{
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new MySqlApartmentRepository();
    }

    public function execute(): array
    {
        $request = $this->apartmentRepository->index();

        $apartments = new IndexApartmentRequest($request);

        return $apartments->getApartments();
    }
}