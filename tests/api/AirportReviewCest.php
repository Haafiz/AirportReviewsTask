<?php


class AirportReviewCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }


    public function getAllStats(ApiTester $I)
    {
        $I->wantTo('see all stats');
        $I->sendGET('/all/stats');

        $I->expect('Response Code is 200');
        $I->seeResponseCodeIs('200');

        $I->expect('Response is JSON');
        $I->seeResponseIsJson();

        $I->expect('Response has stats key');
        $I->seeResponseContains('stats');
    }

    public function getStatsByAirport(ApiTester $I)
    {
        $I->wantTo('see all stats');
        $I->sendGET('/london-heathrow-airport/stats');

        $I->expect('Response Code is 200');
        $I->seeResponseCodeIs('200');

        $I->expect('Response is JSON');
        $I->seeResponseIsJson();

        $I->expect('Response has stats key');
        $I->seeResponseContains('stats');

        $I->expect('Response contains "airport_name":"london-heathrow-airport"');
        $I->seeResponseContains('"airport_name":"london-heathrow-airport"');
    }


    public function getReviewsByAirport(ApiTester $I)
    {
        $I->wantTo('see all stats');
        $I->sendGET('/london-heathrow-airport/reviews');

        $I->expect('Response Code is 200');
        $I->seeResponseCodeIs('200');

        $I->expect('Response is JSON');
        $I->seeResponseIsJson();

        $I->expect('Response has reviews key');
        $I->seeResponseContains('reviews');

        $I->expect('To see date, overall_rating, author_country and content keys in reviews array');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].date');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].overall_rating');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].author_country');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].content');
    }

    public function getReviewsByAirportAndMinimumRating(ApiTester $I)
    {
        $I->wantTo('see reviews by airport greater than and equal to 2');
        $I->sendGET('/london-heathrow-airport/reviews/2');

        $I->expect('Response Code is 200');
        $I->seeResponseCodeIs('200');

        $I->expect('Response is JSON');
        $I->seeResponseIsJson();

        $I->expect('Response has reviews key');
        $I->seeResponseContains('reviews');

        $I->expect('To see date, overall_rating, author_country and content keys in reviews array');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].date');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].overall_rating');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].author_country');
        $I->seeResponseJsonMatchesJsonPath('$.reviews[*].content');

        $I->expect('overall_rating of all reviews greater than and equal to 2');
        $ratings = $I->grabDataFromResponseByJsonPath('$.reviews[*].overall_rating');
        $isRatingLessThanMin = false;
        foreach ($ratings as $rating) {
            $rating = (Float) $rating;
            if ($rating < 2) {
                $isRatingLessThanMin = true;
            }
        }
        $I->assertFalse(($isRatingLessThanMin), "No overall rating less than 2");
    }
}
