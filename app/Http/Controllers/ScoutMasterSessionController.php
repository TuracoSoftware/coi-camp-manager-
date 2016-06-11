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

  public function create(){
    $current_user = Auth::user();

    //check if user is logged in
    if ( $current_user ){

      if ( $current_user->type == 'admin' ){

        return view('admin.scoutmaster.create');

      }

    }

    return view('login');

  }

  public function store(){
    $rules = array(
    'name'    =>   'required'
    );

    $current_user = Auth::user();

    //check if user is logged in


    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator->messages());
    } else {
        $scoutmaster_class= new ScoutMasterSession;

        $scoutmaster_class->name = $request->input('name');
        $scoutmaster_class->description = $request->input('description');
        $scoutmaster_class->fee = $request->input('fee');
        $scoutmaster_class->day = $request->input('day');
        $scoutmaster_class->duration = 'One Day';


        $scoutmaster_class->save();
        return redirect()->to('scoutmaster');
    }
  }
}
