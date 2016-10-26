<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware( "admin" );
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
}
