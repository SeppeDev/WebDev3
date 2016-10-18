<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
    		"code",
    		"ip",
    		"user_id",
    		"period_id",
    ];

    /*Get the user that owns the Entry*/
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /*Get the period tat owns the Entry*/
    public function period()
    {
    	return $this->belongsTo(Period::class);
    }
}
