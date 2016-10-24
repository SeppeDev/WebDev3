<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "isAdmin", "address", "postal_code", "city", "country",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*Get all the entries for the user.*/
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function winner()
    {
        return $this->hasMany(Winner::class);
    }
}
