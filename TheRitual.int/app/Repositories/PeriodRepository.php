<?php

namespace App\Repositories;

use App\Period;
use DateTime;

class PeriodRepository
{
    /**
     * Get all of the periods
     *
     * @return Collection
     */
    public function all()
    {
        return Period::orderBy('start_date', 'asc')
                        ->get();
    }

    public function allWithTrashed()
    {
        return Period::withTrashed()
                        ->orderBy('start_date', 'asc')
                        ->get();
    }

    public function currentPeriod($allPeriods)
    {
        $now = date('Y-m-d H:i:s', strtotime('+2 hours'));
        $currentPeriod = new Period;
        $currentPeriod->name = "There is no active period...";

        foreach ($allPeriods as $period)
        {
            if ($period->start_date < $now && $period->end_date > $now)
            {
                $currentPeriod = $period;
            }
        }

        return $currentPeriod;
    }
}