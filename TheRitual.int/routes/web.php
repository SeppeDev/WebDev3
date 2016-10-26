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

	Route::post("/user/update/{user}", "UserController@update");
	Route::delete("/user/{user}", "UserController@destroy");
	Route::post("/user/restore/{user}", "UserController@restore");
	Route::get("/user/excel", "UserController@export");

	Route::get("/period/add", "PeriodController@index");
	Route::post("/period/create", "PeriodController@store");
	Route::delete("/period/{period}", "PeriodController@destroy");
	Route::post("/period/restore/{period}", "PeriodController@restore");
	Route::get("/period/excel", "PeriodController@export");

	Route::post("/entry", "EntryController@store");
	Route::delete("/entry/{entry}", "EntryController@destroy");
	Route::post("/entry/restore/{entry}", "EntryController@restore");
	Route::get("/entry/excel", "EntryController@export");
	Route::get("/period/excel/{period}", "EntryController@exportEntries");

	Route::get("/dashboard", "DashboardController@index");
