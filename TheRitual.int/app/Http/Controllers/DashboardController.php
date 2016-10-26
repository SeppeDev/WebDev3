<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use DateTime;

use App\Repositories\UserRepository;
use App\Repositories\PeriodRepository;
use App\Repositories\EntryRepository;

class DashboardController extends Controller
{
	protected $users;
	protected $winners;
	protected $periods;
	protected $currentPeriod;
	protected $entries;

    public function __construct(UserRepository $users, EntryRepository $entries, PeriodRepository $periods)
	{
		$this->middleware( "admin" );

		$this->winners = $entries->winningEntries();
		$this->periods = $periods->all();
		$this->entries = $entries->all();
		$this->users = $users->all();
		$this->currentPeriod = $periods->currentPeriod($this->periods);
	}

	public function index(Request $request)
    {
        return view('dashboard/index', [
        	"currentPeriod" => $this->currentPeriod,
        	"users" => $this->users,
        	"winners" => $this->winners,
        	"periods" => $this->periods,
        	"entries" => $this->entries,
        ]);
    }
}
