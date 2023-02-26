<?php


namespace App\Service;

use Analytics;
use Spatie\Analytics\Period;

class AnalyticsService
{

    public function handle()
    {
        $analyticsData = Analytics::performQuery(
            Period::years(1),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth'
            ]
        );

//        $startDate = Carbon::now()->subYear();
//        $endDate = Carbon::now();
//        Period::create($startDate, $endDate);
    }


    public function daysVisitorPageView($day)
    {
       return Analytics::fetchVisitorsAndPageViews(Period::days($day));
    }

    public function mounthVisitorPageView($mounth)
    {
        return Analytics::fetchVisitorsAndPageViews(Period::months($mounth));
    }

}