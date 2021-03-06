<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use DateTime;
use Mail;
use App\Period;

use App\Repositories\PeriodRepository;
use App\Repositories\EntryRepository;

class HomeController extends Controller
{
	protected $winners;
	protected $periods;
	protected $currentPeriod;
	protected $entries;

	public function __construct(EntryRepository $entries, PeriodRepository $periods)
	{
		$this->winners = $entries->winningEntries();
		$this->periods = $periods->all();
		$this->entries = $entries;
		$this->currentPeriod = $periods->currentPeriod($this->periods);
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
}
