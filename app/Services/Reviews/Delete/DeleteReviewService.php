<?php

namespace App\Services\Reviews\Delete;

use App\Repositories\Reviews\MySqlReviewsRepository;
use App\Repositories\Reviews\ReviewsRepository;

class DeleteReviewService
{
    private ReviewsRepository $reviewsRepository;

    public function __construct()
    {
        $this->reviewsRepository = new MySqlReviewsRepository();
    }

    public function execute(DeleteReviewRequest $request)
    {
        $id = $request->getId();

        $this->reviewsRepository->delete($id);
    }
}