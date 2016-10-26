<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Excel;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->middleware( "admin" );

        $this->users = $users->allWithTrashed();
    }

    public function update(Request $request, User $user)
    {
        $user->isAdmin = !$user->isAdmin;
        $user->save();

        return redirect("/dashboard")->with("success", "Successfully updated $user->name");
    }

    public function destroy(Request $request, User $user)
    {
    	$user->delete();

    	return redirect("/dashboard")->with("success", "Successfully deleted $user->name");
    }

    public function restore(Request $request, User $user)
    {
    	$user->restore();

    	return redirect("/dashboard")->with("success", "Successfully restored $user->name");
    }

    public function export(Request $request)
    {
        $now = date('Y-m-d');

        Excel::create("$now - Users", function($excel)
            {
                $excel->sheet("Users", function($sheet)
                {
                    $sheet->loadView("Excel.user", array("users" => $this->users));
                });
            })->export("xls");
    }
}
