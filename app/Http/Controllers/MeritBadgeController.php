<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\MeritBadge;

class MeritBadgeController extends Controller
{
    public function __construct(){
      $this->middleware('auth');

    }
    public function index(){
      if(Auth::user()->type == 'admin'){
        $meritbadge = MeritBadge::all();

        return view('admin.meritbadge.index')
          ->with('meritbadges',$meritbadge);
        }
      }

    public function create(){
          if(Auth::user()->type == 'admin'){
            return view('admin.meritbadge.create');
          }
          else{
            return view('login');
          }
        }

    public function store(Request $request){
      $rules = array();
      $current_user = Auth::user();
  		//check if user is logged in
  		$validator = Validator::make($request->all(), $rules);

  		if($validator->fails()) {
  		  	return redirect()->back()->withErrors($validator->messages());
  		} else {
        $mb = new MeritBadge;
        $mb->name = $request->input('name');
        $mb->save();
        $requirement = new Requirement;
        $requirements = input('requirements');

        $requirement->save();
    }
    if(Auth::user()->type == 'admin'){
      $meritbadge = MeritBadge::all();

      return view('admin.meritbadge.index')
        ->with('meritbadges',$meritbadge);
      }
}
}
