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
        return User::get();
    }

    public function allWithTrashed()
    {
        return User::withTrashed()
                        ->get();
    }

    public function admins()
    {
        return User::where("isAdmin", 1)
                        ->get();
    }
}