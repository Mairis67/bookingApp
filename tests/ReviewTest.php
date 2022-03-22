<?php declare(strict_types=1);

namespace Tests;

use App\Models\Review;
use PHPUnit\Framework\TestCase;

class  ReviewTest extends TestCase
{
    public function testName(): void
    {
        $review = new Review('Mairis', 'Nice view', '12/12/2021', 1, 2, 1);

        $this->assertSame('Mairis', $review->getAuthor());
    }

    public function testReview(): void
    {
        $review = new Review('Mairis', 'Nice view', '12/12/2021', 1, 2, 1);

        $this->assertSame('Nice view', $review->getReview());
    }

    public function testCreatedAt(): void
    {
        $review = new Review('Mairis', 'Nice view', '12/12/2021', 1, 2, 1);

        $this->assertSame('12/12/2021', $review->getCreatedAt());
    }

    public function testAuthorId(): void
    {
        $review = new Review('Mairis', 'Nice view', '12/12/2021', 1, 2, 1);

        $this->assertSame(1 , $review->getAuthorId());
    }

    public function testApartmentId(): void
    {
        $review = new Review('Mairis', 'Nice view', '12/12/2021', 1, 2, 1);

        $this->assertSame(2 , $review->getApartmentId());
    }

    public function testId(): void
    {
        $review = new Review('Mairis', 'Nice view', '12/12/2021', 1, 2, 1);

        $this->assertSame(1 , $review->getId());
    }
}
