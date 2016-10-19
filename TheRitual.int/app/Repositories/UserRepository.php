<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * Get all of the users
     *
     * @return Collection
     */
    public function all()
    {
        return User::orderBy('created_at', 'asc')
                        ->get();
    }
}