<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

    protected $fillable = [
    		"code",
    		"ip",
    		"user_id",
    		"period_id",
            "isWinner",
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
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
