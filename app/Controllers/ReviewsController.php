<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\Services\Reviews\Delete\DeleteReviewRequest;
use App\Services\Reviews\Delete\DeleteReviewService;
use App\Services\Reviews\Review\StoreReviewRequest;
use App\Services\Reviews\Review\StoreReviewService;
use App\Services\Reviews\Show\ShowReviewsRequest;
use App\Services\Reviews\Show\ShowReviewsService;

class ReviewsController
{
    public function show($apartmentId): array
    {
        $service = new ShowReviewsService();

        return $service->execute(new ShowReviewsRequest($apartmentId));
    }

    public function review(array $vars): Redirect
    {

        $apartmentId = (int)$vars['id'];

        $service = new StoreReviewService();

        $service->execute(new StoreReviewRequest(
            $_SESSION['username'],
            $_POST['review'],
            $apartmentId,
            $_SESSION['id']
        ));

        return new Redirect('/apartments' . $apartmentId);
    }

    public function delete(array $vars): Redirect
    {
        $reviewId = (int)$vars['id'];

        $service = new DeleteReviewService();

        $service->execute(new DeleteReviewRequest($reviewId));

        return new Redirect('/apartments/' . (int)$vars['nr']);
    }
}