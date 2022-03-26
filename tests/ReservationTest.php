<?php

namespace Tests;

use App\Models\Reservation;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    public function testReservationFrom():void
    {
        $reservation = new Reservation('12/12/2022', '20/12/2022', 1, 2, 5);

        $this->assertSame('12/12/2022', $reservation->getReservationFrom());
    }

    public function testReservationTo():void
    {
        $reservation = new Reservation('12/12/2022', '20/12/2022', 1, 2, 5);

        $this->assertSame('20/12/2022', $reservation->getReservationTo());
    }

    public function testReservationId():void
    {
        $reservation = new Reservation('12/12/2022', '20/12/2022', 1, 2, 5);

        $this->assertSame(1, $reservation->getId());
    }

    public function testUserId():void
    {
        $reservation = new Reservation('12/12/2022', '20/12/2022', 1, 2, 5);

        $this->assertSame(2, $reservation->getUserId());
    }

    public function testApartmentId():void
    {
        $reservation = new Reservation('12/12/2022', '20/12/2022', 1, 2, 5);

        $this->assertSame(5, $reservation->getApartmentId());
    }

}
