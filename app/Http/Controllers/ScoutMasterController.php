<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Scoutmaster;

use Auth;
use Validator;

class ScoutMasterController extends Controller
{
    // Start the auth class to determine user type
    public function __constuct()  {
      $this->middleware('auth');
    }
    // Gather infromation for index page
    public function index(){
      if(Auth::user()->type == 'admin'){
        $scoutmaster = Scoutmaster::all();        // Get all the scoutmasters
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

    public function create() {
      return view('scoutmaster.create');
    }

    public function store(Request $request) {
  		$rules = array(
  		'firstname'    =>   'required'
  		);

  		$current_user = Auth::user();

  		//check if user is logged in


  		$validator = Validator::make($request->all(), $rules);

  		if($validator->fails()) {
  		  	return redirect()->back()->withErrors($validator->messages());
  		} else {
  		    $scoutmaster = new Scoutmaster;

  		    $scoutmaster->firstname = $request->input('firstname');
  		    $scoutmaster->lastname = $request->input('lastname');
  		    if(Auth::user()->type != 'admin')
  		    	$scoutmaster->troop_id = Auth::user()->troop->id;

  		    $scoutmaster->save();
  		    return redirect()->to('scoutmaster');
  		}

      }
}
