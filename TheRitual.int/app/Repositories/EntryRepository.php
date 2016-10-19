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
                        ->get();
    }
}