<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Mail;

use App\Entry;

use App\Repositories\PeriodRepository;
use App\Repositories\UserRepository;

class EntryController extends Controller
{
    protected $periods;
    protected $currentPeriod;
    protected $admins;

	public function __construct(PeriodRepository $periods, UserRepository $users)
	{
		$this->periods = $periods->all();
		$this->currentPeriod = $periods->currentPeriod($this->periods);
        $this->admins = $users->admins();
	}

    public function store(Request $request)
    {
    	$this->validate( $request, [	"code" => "required|max:10|unique:entries",
    									]);

    	
    	return redirect( $this->checkWinner($request));
    }

    public function destroy(Request $request, Entry $entry)
    {
        $entry->delete();

        return redirect("/dashboard");
    }

    //Private functions
    private function checkWinner(Request $request)
    {
    	if ($this->currentPeriod->code == $request->code)
    	{
    		$request->user()->entries()->create([	"code" => $request->code,
    											"ip" => $request->ip(),
    											"period_id" => $this->currentPeriod->id,
    											"isWinner" => true,
    											]);


    		$this->sendWinnerEmail($request);
            $this->sendAdminWinnerEmail($request);
    		return "/";
    	}
    	else
    	{
    		$request->user()->entries()->create([	"code" => $request->code,
    											"ip" => $request->ip(),
    											"period_id" => $this->currentPeriod->id,
    											"isWinner" => false,
    											]);

    		$this->sendEntryEmail($request);
    		return "/";
    	}
    }

    private function sendEntryEmail(Request $request)
    {
        $user = $request->user();

        Mail::send('mails.entryMail', ['request' => $request], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('You performed a Ritual');
        });
    }

    private function sendWinnerEmail(Request $request)
    {
        $user = $request->user();

        Mail::send('mails.winnerMail', ['request' => $request], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('You performed a Ritual and WON');
        });
    }

    private function sendAdminWinnerEmail(Request $request)
    {
        foreach($this->admins as $admin)
        {
            Mail::send('mails.adminWinnerMail', ['request' => $request, "admin" => $admin], function ($message) use ($admin) {
                $message->to($admin->email);
                $message->subject('Some performed a winning Ritual');
            });
        }
    }
}