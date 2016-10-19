<?php

namespace App\Repositories;

use App\Winner;

class WinnerRepository
{
    /**
     * Get all of the winners
     *
     * @return Collection
     */
    public function all()
    {
        return Winner::orderBy('created_at', 'asc')
                        ->get();
    }
}