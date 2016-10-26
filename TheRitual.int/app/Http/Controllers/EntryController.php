<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Mail;

use App\Entry;
use App\Period;
use Excel;

use App\Repositories\PeriodRepository;
use App\Repositories\UserRepository;
use App\Repositories\EntryRepository;

class EntryController extends Controller
{
    protected $periods;
    protected $currentPeriod;
    protected $admins;
    protected $entries;

	public function __construct(PeriodRepository $periods, UserRepository $users, EntryRepository $entries)
	{
		$this->currentPeriod = $periods->currentPeriod($periods->all());
        $this->admins = $users->admins();
        $this->entries = $entries;
	}

    public function store(Request $request)
    {
    	$this->validate( $request, [	"code" => "required|max:10|min:10|unique:entries",
    									]);

    	
    	return $this->checkWinner($request);
    }

    public function destroy(Request $request, Entry $entry)
    {
        $entry->delete();

        return redirect("/dashboard")->with("success", "Successfully deleted $entry->name");
    }

    public function restore(Request $request, Entry $entry)
    {
        $entry->restore();

        return redirect("/dashboard")->with("success", "Successfully restored $entry->name");
    }

    public function export(Request $request)
    {
        $now = date('Y-m-d');

        Excel::create("$now - Entries", function($excel)
            {
                $excel->sheet("Entries", function($sheet)
                {
                    $sheet->loadView("Excel.entry", array("entries" => $this->entries->allWithTrashed()));
                });
            })->export("xls");
    }

    public function exportEntries(Request $request, Period $period)
    {
        $now = date('Y-m-d');

        Excel::create("$now - Entries of period $period->name", function($excel) use ($period)
            {
                $excel->sheet("Entries", function($sheet) use ($period)
                {
                    $sheet->loadView("Excel.entryOfPeriod", array("entries" => $this->entries->entryOfPeriod($period->id)));
                });
            })->export("xls");
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
    		
            return redirect("/")->with("success", "YOU PERFORMED A RITUAL WITH '$request->code' AND WON!!! You'll recieve a mail with instructions on how to get your price. Congratulations!!!");
    	}
    	else
    	{
    		$request->user()->entries()->create([	"code" => $request->code,
    											"ip" => $request->ip(),
    											"period_id" => $this->currentPeriod->id,
    											"isWinner" => false,
    											]);

    		$this->sendEntryEmail($request);
    		
            return redirect("/")->with("success", "You performed a ritual with '$request->code' but did not win. Better luck next time!");
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
