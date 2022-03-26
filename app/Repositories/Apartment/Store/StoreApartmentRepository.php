<?php

namespace App\Repositories\Apartment\Store;

use App\Models\Apartment;

interface StoreApartmentRepository
{
    public function save(Apartment $apartment): void;
}