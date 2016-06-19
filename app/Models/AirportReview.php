<?php
namespace dreamlines\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AirportReview extends Model
{
    /**
    * Get all stats grouped by airport_name
    *
    * @return Collection
    */
    public function getAllStats()
    {
        $stats = $this->select(DB::raw('count(*) as review_count'), 'airport_name')
            ->groupBy('airport_name')
            ->orderBy('review_count', 'desc')->get();

        return $stats;
    }


    /**
    * Get stats for particular airport_name
    *
    * @param String $airportName
    * @return Object
    */
    public function getStatsByAirport($airportName)
    {
        $stats = $this->select(
                DB::raw('count(*) as review_count'),
                'airport_name',
                DB::raw('avg(overall_rating) as average_rating'),
                DB::raw('sum(recommended) as recommendations_total')
            )
            ->where("airport_name", $airportName)
            ->groupBy('airport_name')
            ->orderBy('review_count', 'desc')->get();

        if (count($stats)) {
            return $stats->first();
        } else {
            return null;
        }
    }


    /**
    * Get reviews for particular airport
    *
    * @param String $airportName
    * @param Number $minRating
    * @return Collection
    */
    public function getReviewsByAirport($airportName, $minRating)
    {
        $reviews = $this->select('date', 'overall_rating', 'author_country', 'content')
            ->where("airport_name", $airportName)
            -> where('overall_rating', '>=', $minRating)
            ->orderBy('date', 'desc')->get();

        return $reviews;
    }
}
