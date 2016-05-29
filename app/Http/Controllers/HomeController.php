<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Troop;
use App\Scout;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Return the currect view based on what type of user is attempting to access a system
     */
    public function index() {
        if(Auth::user()->type == 'admin') {
            return redirect()->to('/administrator');
        } elseif (Auth::user()->type == 'director') {
            return redirect()->to('/director');
        } elseif (Auth::user()->type == 'staff') {
            return redirect()->to('/staff');
        } else {
            return view('home');
        }
    }

    /**
    * The Admin home gets the latest 7 troops to desplay on the dashboard, also counts the
    * number of troops
    * TODO: Need to add a way to calculate estimated fees to be collected this summer.
    */
    public function admin_home() {

      $troops = 0;
      // this will return the last seven troops
      $troops = Troop::latest()->take(7)->get();
      // this will count all the scouts for the summer
      $scout_count = Scout::count();
      // this will count all the troops for the summer
      $troop_count = Troop::count();
      if(Auth::user()->type == 'admin')             // Test to see if the user is an admin
        return view('admin.home')
              ->with('troops',$troops)              // Return troops to admin.home view
              ->with('troop_count', $troop_count)   // Return count of all troops to admin.home view
              ->with('scout_count',$scout_count);        // Return count of all scouts to admin.home view

    }
}
