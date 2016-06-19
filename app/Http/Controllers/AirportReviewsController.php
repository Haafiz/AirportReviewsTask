<?php
namespace dreamlines\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class AirportReviewsController extends Controller
{
    public function __construct(\dreamlines\Models\AirportReview $review)
    {
        $this->model = $review;
    }

    public function getAllStats()
    {
        return ['stats' => $this->model->getAllStats()];
    }

    public function getStats($airport_name)
    {
        $stats = $this->model->getStatsByAirport($airport_name);
        if ($stats) {
            return ['stats' => $stats];
        } else {
            return ['error' => "No stats Found"];
        }
    }

    public function getReviews($airport_name, $minRating = 0)
    {
        $reviews = $this->model->getReviewsByAirport($airport_name, $minRating);
        if (count($reviews)) {
            return ['reviews' => $reviews];
        } else {
            return ['error' => "No review Found"];
        }
    }

    //select count(airport_name) review_count from airports group by airport_name order by review_count desc;
}
