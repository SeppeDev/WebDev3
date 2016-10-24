<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

	Route::get('/welcome', function () {
	    return view('welcome');
	});

	Auth::routes();
	
	Route::get("/", "HomeController@index");

	//Route::get("/entries", "EntryController@index");
	Route::post("/entry", "HomeController@store");
	//Route::delete("/entry/{entry", "EntryController@destroy");
