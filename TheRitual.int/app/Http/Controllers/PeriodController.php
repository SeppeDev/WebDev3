<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Period;
use Excel;

use App\Repositories\PeriodRepository;

class PeriodController extends Controller
{
    protected $periods;

	public function __construct(PeriodRepository $periods)
	{
        $this->middleware( "admin" );

        $this->periods = $periods->allWithTrashed();
	}

    public function index(Request $request)
    {
        return view('addPeriod/index');
    }

    public function store(Request $request)
    {
    	$this->validate( $request, [	"name" => "required|unique:periods",
                                        "start_date" => "required|date_format:Y-m-d H:i:s",
                                        "end_date" => "required|date_format:Y-m-d H:i:s|after:start_date",
                                        "code" => "required|min:10|max:10|unique:periods",
    									]);

    	$newPeriod = new Period;
    	$newPeriod->name = $request->name;
    	$newPeriod->start_date = $request->start_date;
    	$newPeriod->end_date = $request->end_date;
    	$newPeriod->code = $request->code;
    	$newPeriod->save();

    	
    	return redirect("/dashboard")->with("success", "New period '$newPeriod->name' successfully created!");
    }

    public function destroy(Request $request, Period $period)
    {
        $period->delete();

        return redirect("/dashboard")->with("success", "Successfully deleted $period->name");
    }

    public function restore(Request $request, Period $period)
    {
        $period->restore();

        return redirect("/dashboard")->with("success", "Successfully restored $period->name");
    }

    public function export(Request $request)
    {
        $now = date('Y-m-d');

        Excel::create("$now - Periods", function($excel)
            {
                $excel->sheet("Periods", function($sheet)
                {
                    $sheet->loadView("Excel.period", array("periods" => $this->periods));
                });
            })->export("xls");
    }
}
