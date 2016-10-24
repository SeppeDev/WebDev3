<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
    		"user_id",
    		"period_id",
    		"winning_code",
    ];

    /*Get the user that belongs to the Winner*/
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /*Get the period that belongs to the Winner*/
    public function period()
    {
    	return $this->belongsTo(Period::class);
    }
}
