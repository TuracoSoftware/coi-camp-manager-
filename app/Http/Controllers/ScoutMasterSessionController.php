<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScoutMasterSessionController extends Controller
{
  public function __constuct(){
    $this->middleware('auth');
  }

  public function index(){
    if(Auth::user()->type == 'admin'){
      $scoutmaster = Scoutmaster::all();

      return view('admin.scoutmaster.index')
        ->with('scoutmasters',$scoutmaster);

    }else{
			if(Auth::user()->troop)
		  		$scoutmaster = Scoutmaster::where('troop_id', Auth::user()->troop->id)
		                    	->get();
		    else
		    	$scoutmaster = [];

			return view('scoutmaster.index')
		    	  ->with('scoutmasters',$scoutmaster);

		}

  }
}
