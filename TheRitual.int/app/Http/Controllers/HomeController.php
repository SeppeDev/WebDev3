<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use DateTime;

use App\Winner;

use App\Repositories\WinnerRepository;
use App\Repositories\PeriodRepository;
use App\Repositories\EntryRepository;

class HomeController extends Controller
{
	protected $winners;
	protected $periods;
	protected $currentPeriod;
	protected $entries;

	public function __construct(WinnerRepository $winners, EntryRepository $entries, PeriodRepository $periods)
	{
		$this->winners = $winners->all();
		$this->periods = $periods->all();
		$this->entries = $entries;

		$this->calcCurrentPeriod();
	}

    public function index(Request $request)
    {
        return view('home/index', [
        	"currentPeriod" => $this->currentPeriod,
        	"winners" => $this->winners,
        	"periods" => $this->periods,
        	"entries" => $this->entries->entryOfUser( Auth::check() ? Auth::user()->id : -1 ),
        ]);
    }

    public function store(Request $request)
    {
    	$this->validate( $request, [	"code" => "required|max:10",
    									]);

    	$request->user()->entries()->create([	"code" => $request->code,
    											"ip" => $request->ip(),
    											"period_id" => $this->currentPeriod->id,
    											]);

    	if ($this->checkWinner($request->code))
    	{
    		$this->createWinner($request->user()->id, $this->currentPeriod->id);

    		return redirect( "/" );
    	}
    	else
    	{
    		return redirect( "/" );
    	}
    }


    //Private functions
    private function calcCurrentPeriod()
    {
    	$now = date('Y-m-d H:i:s');
    	foreach ($this->periods as $period)
    	{
    		if ($period->start_date < $now && $period->end_date > $now)
    		{
    			$this->currentPeriod = $period;
    		}
    		
    	}
    }

    private function checkWinner($code)
    {
    	if ($this->currentPeriod->code == $code)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    private function createWinner($user_id, $period_id)
    {
    	$newWinner = new Winner;
    	$newWinner->user_id = $user_id;
    	$newWinner->period_id = $period_id;
    	$newWinner->save();
    }
}
