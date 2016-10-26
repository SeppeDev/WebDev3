<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    protected $fillable = [
    		"start_date",
    		"end_date",
    		"code",
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
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
