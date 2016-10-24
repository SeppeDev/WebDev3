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

class DashboardController extends Controller
{
	protected $winners;
	protected $periods;
	protected $currentPeriod;
	protected $entries;

    public function __construct(WinnerRepository $winners, EntryRepository $entries, PeriodRepository $periods)
	{
		$this->middleware( "admin" );

		$this->winners = $winners->all();
		$this->periods = $periods->all();
		$this->entries = $entries;
	}

	public function index(Request $request)
    {
        return view('dashboard/index', [
        	"currentPeriod" => $this->currentPeriod,
        	"winners" => $this->winners,
        	"periods" => $this->periods,
        	"entries" => $this->entries->entryOfUser( Auth::check() ? Auth::user()->id : -1 ),
        ]);
    }
}
