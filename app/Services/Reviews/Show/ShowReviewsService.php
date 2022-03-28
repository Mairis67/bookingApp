<?php

namespace App\Services\Reviews\Show;

use App\Database;
use App\Models\Review;
use App\Repositories\Reviews\MySqlReviewsRepository;
use App\Repositories\Reviews\ReviewsRepository;

class ShowReviewsService
{
    private ReviewsRepository $reviewsRepository;

    public function __construct()
    {
        $this->reviewsRepository = new MySqlReviewsRepository();
    }

    public function execute(ShowReviewsRequest $request): array
    {
        $apartmentId = $request->getApartmentId();

        $response = $this->reviewsRepository->getReviews($apartmentId);

        $reviews = new ShowReviewsResponse($response);

        return $reviews->getReviews();
    }

}