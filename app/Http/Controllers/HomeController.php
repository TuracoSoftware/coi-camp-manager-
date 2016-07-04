<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Troop;
use App\Scout;
use Carbon\Carbon;


class HomeController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
  }

  public function index() {
    /*As the user logins in, this is what redirects them to the appropriate page.
      The staff is based off of current time, to send them to the current week
      of their classes.*/
    if(Auth::user()->type == 'admin') {
      return redirect()->to('/administrator');
    } elseif (Auth::user()->type == 'director') {
      return redirect()->to('/director');
    } elseif (Auth::user()->type == 'staff') {
      $mytime = Carbon::now();
      if(substr($mytime->toDateTimeString(), 5,2) == '06' && intval(substr($mytime->toDateTimeString(),8,2))-19 <= 0) {
        return redirect()->to('/staff/classes/1');
      } elseif (substr($mytime->toDateTimeString(), 5,2) == '06' && intval(substr($mytime->toDateTimeString(),8,2))-26 <= 0) {
        return redirect()->to('/staff/classes/2');
      } elseif (substr($mytime->toDateTimeString(), 5,2) == '06' && intval(substr($mytime->toDateTimeString(),8,2))-30 <= 0 ||
                  substr($mytime->toDateTimeString(), 5,2) == '07' && intval(substr($mytime->toDateTimeString(),8,2))-3 <= 0) {
        return redirect()->to('/staff/classes/3');
      } elseif (substr($mytime->toDateTimeString(), 5,2) == '07' && intval(substr($mytime->toDateTimeString(),8,2))-10 <= 0) {
        return redirect()->to('/staff/classes/4');
      } elseif (substr($mytime->toDateTimeString(), 5,2) == '07' && intval(substr($mytime->toDateTimeString(),8,2))-17 <= 0) {
        return redirect()->to('/staff/classes/5');
      } elseif (substr($mytime->toDateTimeString(), 5,2) == '07' && intval(substr($mytime->toDateTimeString(),8,2))-24 <= 0) {
        return redirect()->to('/staff/classes/6');
      } elseif (substr($mytime->toDateTimeString(), 5,2) == '07' && intval(substr($mytime->toDateTimeString(),8,2))-31 <= 0) {
        return redirect()->to('/staff/classes/7');
      } else {
        return redirect()->to('/staff/classes/1');
      }
    } else {
      return redirect()->to('/troop');
    }
  }

  public function admin_home() {
    $troops = 0;
    // this will return the last seven troops
    $troops_1 = Troop::latest()->take(1)->get();
    $troops_3 = Troop::latest()->take(3)->get();
    $troops_7 = Troop::latest()->take(7)->get();
    // this will count all the scouts for the summer
    $scout_count = Scout::count();
    // this will count all the troops for the summer
    $troop_count = Troop::count();

    $scouts = Scout::all();
    $scout_classes = array();
    $total_fee = 0;
    foreach($scouts as $key=>$scout) {
      $scout_classes[] = $scout->classes;
    }
    foreach($scout_classes as $key=>$val) {
      foreach($val as $key=>$value) {
        $total_fee += $value->fee;
      }
    }
    if(Auth::user()->type == 'admin')             // Test to see if the user is an admin
      return view('admin.home')
                  ->with('troops_1',$troops_1)              // Return troops to admin.home view
                  ->with('troops_3',$troops_3)
                  ->with('troops_7',$troops_7)
                  ->with('troop_count', $troop_count)   // Return count of all troops to admin.home view
                  ->with('total_fee', $total_fee)
                  ->with('scout_count',$scout_count);    // Return count of all scouts to admin.home view
  }

  public function allScouts() {
    if(Auth::user()->type == 'admin') {
      $scouts = Scout::all();
      return view('admin.all_scouts')
                  ->with('scouts',$scouts);
    } else {
      $this->admin_home();
    }
  }
}
