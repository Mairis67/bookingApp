<?php

namespace App\Repositories\Apartment;

use App\Models\Apartment;

interface ApartmentRepository
{
    public function store(Apartment $apartment): void;

    public function getById(int $apartmentId): Apartment;

    public function index(): array;

    public function delete(int $apartmentId): void;

    public function edit(int $apartmentId): Apartment;

    public function show(int $apartmentId): Apartment;

    public function update (Apartment $apartment): void;
}