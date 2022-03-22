<?php declare(strict_types=1);

namespace Tests;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testName(): void
    {
        $name = new User('Mairis', 'Alksnis', 'mairis@gmail.com', '1234');

        $this->assertSame('Mairis', $name->getName());
    }

    public function testSurname(): void
    {
        $name = new User('Mairis', 'Alksnis', 'mairis@gmail.com', '1234');

        $this->assertSame('Alksnis', $name->getSurname());
    }

    public function testEmail(): void
    {
        $name = new User('Mairis', 'Alksnis', 'mairis@gmail.com', '1234');

        $this->assertSame('mairis@gmail.com', $name->getEmail());
    }

    public function testPassword(): void
    {
        $name = new User('Mairis', 'Alksnis', 'mairis@gmail.com', '1234');

        $this->assertSame('1234', $name->getPassword());
    }
}
