<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function destroy(Request $request, User $user)
    {
    	$user->delete();

    	return redirect("/dashboard");
    }
}
