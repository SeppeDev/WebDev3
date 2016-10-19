<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Winner;
use App\Repositories\WinnerRepository;

class HomeController extends Controller
{
	protected $winners;

	public function __construct(WinnerRepository $winners)
	{
		$this->winners = $winners;
	}

    public function index(Request $request)
    {
        return view('home/index', [
        	"winners" => $this->winners->all(),
        ]);
    }
}
