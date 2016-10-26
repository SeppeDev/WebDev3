<?php

namespace App\Repositories;

use App\Entry;

class EntryRepository
{
    /**
     * Get all of the entrys
     *
     * @return Collection
     */
    public function all()
    {
        return Entry::orderBy('created_at', 'asc')
                        ->with("user", "period")
                        ->get();
    }

    public function entryOfUser( $id )
    {
        return Entry::where("user_id", $id)
                        ->with("period")
                        ->get();
    }

    public function winningEntries()
    {
        return Entry::where("isWinner", true)
                        ->orderBy('created_at', 'asc')
                        ->with( array("user" => function($query)
                                    {
                                        $query->select("id", "name", "city", "country");
                                    })
                            )
                        ->get();
    }
}