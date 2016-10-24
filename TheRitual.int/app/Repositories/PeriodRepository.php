<?php

namespace App\Repositories;

use App\Period;

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
}