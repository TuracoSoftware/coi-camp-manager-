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
public function update($id, Request $request)
{
  /*$editables = array(
    'name',
    'email',
    'new_password',
    'type'
  );
  $user = User::find($id);
  if(Auth::user()->type == 'admin' ){
    $validator = Validator::make($request->all());

    if($validator->fails()) {
      return redirect()->back()->withErrors($validator->messages());
    } else {
      foreach($editables as $key=>$value) {
        if($value == 'new_password') {
          if($request->input($value) == $request->input('confirm_password')) {
            $user->password = $request->input(bcrypt($value));
          }
        } else if(!($value==NULL)) {
          $user->$value = $request->input($value);
        }
      }
      $user->save();
      return view('admin.staff.staff');
      }
  }*/
  $staff = Staff::find($id);
  $user = $staff->user;
  $rules = array();
  $validator = Validator::make($request->all(), $rules);
  if($validator->fails()) {
    return redirect()->back()->withErrors($validator->messages());
  } else {
      if($request->input('name')) {
        $user->name = $request->input('name');
      }
      if($request->input('email')) {
        $user->email = $request->input('email');
      }
      if($request->input('new_password')) {
        if($request->input('new_password') == $request->input('confirm_password')) {
          $user->password = $request->input(bcrypt('new_password'));
        }
      }
      if($request->input('type')) {
        $user->type = $request->input('type');
      }
      $user->save();

      if($request->input('description')) {
        $staff->description = $request->input('description');
      }
      if($request->input('department')) {
        $staff->department = $request->input('department');
      }
      $staff->save();

      $staff = Staff::all();
      return view('admin.staff.index')
                ->with('staff', $staff);
  }
}
}
