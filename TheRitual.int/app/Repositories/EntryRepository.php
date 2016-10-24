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
                        ->with("period")
                        ->get();
    }

    public function entryOfUser( $id )
    {
        return Entry::where("user_id", $id)
                        ->orderBy('created_at', 'asc')
                        ->with( "period")
                        ->get();
    }
}