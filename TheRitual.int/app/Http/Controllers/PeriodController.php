<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Period;

class PeriodController extends Controller
{
	public function __construct()
	{

	}

    public function store(Request $request)
    {
    	$this->validate( $request, [	"code" => "required|max:10|unique:entries",
    									]);

    	$newPeriod = new Period;
    	$newPeriod->name = $request->name;
    	$newPeriod->start_date = $request->start_date;
    	$newPeriod->end_date = $request->end_date;
    	$newPeriod->code = $request->code;
    	$newPeriod->save();

    	
    	return redirect("/dashboard");
    }

    public function destroy(Request $request, Period $period)
    {
        $period->delete();

        return redirect("/dashboard");
    }
}
