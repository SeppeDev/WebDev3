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
                        ->with( array("user" => function($query)
                                    {
                                        $query->select("id", "name", "city", "country");
                                    })
                            )
                        ->get();
    }
}