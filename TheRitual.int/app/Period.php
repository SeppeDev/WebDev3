<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
    		"start_date",
    		"end_date",
    		"code",
    ];

    /*Get all the entries for the Period.*/
    public function entries()
    {
    	return $this->hasMany(Entry::class);
    }

    public function winners()
    {
    	return $this->hasMany(Winner::class);
    }
}
