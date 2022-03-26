<?php

namespace Tests;

use App\Models\Apartment;
use PHPUnit\Framework\TestCase;

class ApartmentTest extends TestCase
{
    public function testApartmentName()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame('Radison', $apartment->getName());
    }

    public function testApartmentDescription()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame('Beutiful', $apartment->getDescription());
    }

    public function testApartmentAddress()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame('Riga', $apartment->getAddress());
    }

    public function testApartmentAvailableFrom()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame('12/12/2022', $apartment->getAvailableFrom());
    }

    public function testApartmentAvailableTo()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame('20/12/2022', $apartment->getAvailableTo());
    }

    public function testApartmentId()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame(1, $apartment->getId());
    }

    public function testApartmentUserId()
    {
        $apartment = new Apartment('Radison', 'Beutiful', 'Riga', '12/12/2022',
            '20/12/2022', 1, 2);

        $this->assertSame(2, $apartment->getUserId());
    }
}
