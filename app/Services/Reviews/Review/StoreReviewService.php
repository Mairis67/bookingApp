<?php

namespace App\Services\Reviews\Review;

use App\Database;
use App\Repositories\Reviews\MySqlReviewsRepository;
use App\Repositories\Reviews\ReviewsRepository;

class StoreReviewService
{
    private ReviewsRepository $reviewsRepository;

    public function __construct()
    {
        $this->reviewsRepository = new MySqlReviewsRepository();
    }

    public function execute(StoreReviewRequest $request)
    {
        $author = $request->getAuthor();
        $review = $request->getReview();
        $authorId = $request->getAuthorId();
        $apartmentId = $request->getApartmentId();

        $this->reviewsRepository->storeReviews($author, $review, $authorId, $apartmentId);
    }
}