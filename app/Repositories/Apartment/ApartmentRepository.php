<?php

namespace App\Repositories\Apartment;

use App\Models\Apartment;

interface ApartmentRepository
{
    public function save(Apartment $apartment): void;
}