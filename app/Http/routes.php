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

    Route::resource('troop', 'TroopController');
    Route::resource('scout', 'ScoutController');
    Route::resource('sclass', 'SclassController');
    Route::resource('session', 'SessionController');
    Route::resource('scoutmaster', "ScoutMasterController");
    Route::resource('scout_class', 'Scout_Class_Controller');

    /*Scout controls*/
    Route::get('/scout/{id}/schedule', 'ScoutController@schedule');
    Route::put('/scout/{id}/schedule', 'ScoutController@update_schedule');
    Route::post('/scout/search', 'ScoutController@search_by_name');

    /*Scoutmaster controls*/
    Route::get('/scoutmaster/{id}/schedule', 'ScoutMasterController@schedule');
    Route::put('/scoutmaster/{id}/schedule', 'ScoutMasterController@update_schedule');

    /*PDF views*/
    Route::get('scout_print_view/{id}', 'PdfController@scout_print');
    Route::get('roster_print_view/{sclass_id}/{week}', 'PdfController@roster_print');

    Route::get('staff', function() {
      return view('staff.index');
    });

    Route::auth();

    Route::get('/', function () {
      return view('welcome');
    });

    Route::group(['prefix' => 'administrator'], function()
    {
        Route::get('/', 'TroopController@troop_home');
        Route::resource('troop', 'TroopController');
        Route::resource('scout', 'ScoutController');
        Route::resource('sclass', 'SclassController');
        Route::resource('session', 'SessionController');
        Route::resource('scout_class', 'Scout_Class_Controller');

        Route::get('week/{id}', 'ScoutController@week');
        Route::get('troop/{id}/addscout', 'TroopController@addscout');

        Route::get('roster', 'RosterController@index');
        Route::post('roster', 'RosterController@generate');

        Route::get('AllRosters/{week}/{day}', 'PdfController@roster_print_week');

        Route::resource('display_users', 'UserController@display_all');
        Route::get('create_user', function() {
          return view('admin.users.create');
        });
        Route::get('edit_users', function() {
          return view('admin.users.edit');
        });
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
