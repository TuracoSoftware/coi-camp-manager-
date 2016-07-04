<?php

use App\Troop;


/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
  /*These are the CRUD routes for each object*/
  Route::resource('staff', 'StaffController');
  Route::resource('troop', 'TroopController');
  Route::resource('scout', 'ScoutController');
  Route::resource('sclass', 'SclassController');
  Route::resource('session', 'SessionController');
  Route::resource('director', 'DirectorController');
  Route::resource('scoutmaster', "ScoutMasterController");
  Route::resource('scout_class', 'Scout_Class_Controller');

  /*Scout controls*/
  Route::get('/scout/{id}/schedule', 'ScoutController@schedule');
  /*If admin view: admin.scouts.schedule
    else view: scouts.schedule*/
  Route::put('/scout/{id}/schedule', 'ScoutController@update_schedule');
  /*Redirects to view: troop*/
  Route::post('/scout/search', 'ScoutController@search_by_name');
  /*If admin view: admin.scouts.index
    elseif user is the scout master of the troop view: scouts.index
    else Redirects to scout*/

  /*Scoutmaster controls*/
  Route::get('/scoutmaster/{id}/schedule', 'ScoutMasterController@schedule');
  /*If admin view: admin.scoutmaster.schedule
    else view: scoutmaster.schedule*/
  Route::put('/scoutmaster/{id}/schedule', 'ScoutMasterController@update_schedule');


  /*PDF views*/
  Route::get('scout_print_view/{id}', 'PdfController@scout_print');
  //view: pdf.scoutschedule
  Route::get('roster_print_view/{sclass_id}/{week}', 'PdfController@roster_print');
  //view: pdf.roster
  Route::get('troop/{id}/roster_print', 'PdfController@troop_print');
  //view: pdf.all_scouts_troop_schedule
  Route::get('scout_advancement_print/{id}', 'PdfController@scout_advancement');
  //view: pdf.scout_advancement

  //Staff views
  Route::get('staff/roster', 'StaffController@roster');
  //view: staff.roster
  Route::get('staff/classes/{week}', 'StaffController@classes');
  //view: staff.classes
  Route::get('staff/roster/{class_id}/{week}', 'StaffController@class_roster');
  //view: staff.class_roster
  Route::get('staff/advancement/{class_id}/{week}', 'StaffController@advancement');
  //view: staff.advancement
  Route::post('staff/advancement/input', 'StaffController@input');
  //Redirects to staff/classes/(current week here)
  Route::get('staff/{id}/{week}/schedule','StaffController@schedule');
  /*If admin or director view: admin.staff.schedule
    else Redirects to home*/
  Route::post('staff/{id}/schedule/update', 'StaffController@update_schedule');
  //Redirects to staff

  Route::auth();
  Route::get('/', function () {
    return view('welcome');
  });

  Route::group(['prefix' => 'administrator'], function() {

    Route::get('/', 'HomeController@admin_home');
    /*These are the CRUD routes for each object*/
    Route::resource('troop', 'TroopController');
    Route::resource('scout', 'ScoutController');
    Route::resource('sclass', 'SclassController');
    Route::resource('session', 'SessionController');
    Route::resource('scout_class', 'Scout_Class_Controller');
    Route::resource('meritbadge','MeritBadgeController');
    Route::resource('users', 'UserController');
    Route::resource('staff', 'StaffController');
    Route::resource('director', 'DirectorController');

    Route::get('week/{id}', 'ScoutController@week');
    /*If admin view: admin.scouts.index
      else view: scouts.index*/
    Route::resource('troop/{id}/addscout', 'TroopController@addScout');
    //view: admin.troops.add_scout
    Route::resource('troop/{id}/addscout/update', 'TroopController@addScoutUpdate');
    //Redirects to troop
    Route::resource('all_scouts', 'HomeController@allScouts');
    //If admin view: admin.all_scouts

    Route::get('roster', 'RosterController@index');
    /*If admin view: admin.roster.index
      else Redirects to login*/
    Route::post('roster', 'RosterController@generate');
    //view: admin.roster.index

    Route::get('AllRosters/{week}/{day}', 'PdfController@roster_print_week');
    //view: pdf.roster_day
    Route::get('troop/profile/{id}', 'TroopController@profile');
    //view: admin.troops.profile
    Route::get('scout/all_schedule/{week}', 'PdfController@all_scout_schedule');
    //view: pdf.all_scouts_schedule
  });

  Route::get('/administrator/test', function () {
    return view('admin.troop.view');
  });

  Route::get('/home', 'HomeController@index');

  Route::get('/sessionregistration', function() {
    return view('sessionregistration');
  });

  Route::get('/scoutregistration', function() {
    return view('scoutregistration');
  });
});
