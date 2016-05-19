<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Staff;
use Validator;

class StaffController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

  public function index() {
    $users = User::where('type', 'staff')->get();
    $staff = Staff::all();
    $used = False;
    $unused = array();
    $count = 0;
    foreach($users as $key=>$user) {
      foreach($staff as $key=>$sMem) {
        if($sMem->user_id == $user->id) {
          $used = True;
          break;
        }
      }
      if(!$used) {
        $unused[$count] = $user->id;
        $count++;
      }
    }
    foreach($unused as $key=>$val) {
      $sMem = new Staff;
      $sMem->user_id = $val;
      $sMem->save();
    }
    $staff = Staff::all();
    return view('admin.staff.index')->with('staff', $staff);
    /*$staff = Staff::all();
    return view('admin.staff.index')
              ->with('staff', $staff);*/
  }

  public function create() {
    $current_user = Auth::user();
    if ( $current_user ){
      if(Auth::user()->type == 'admin'){
        return view('admin.staff.create');
      }
    }
  }

  public function store(Request $request) {
    $rules = array(
      'description'  =>  'required'
    );
    $current_user = Auth::user();
		//check if user is logged in
		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
		  	return redirect()->back()->withErrors($validator->messages());
		} else {
      $users = User::all();
      $test_unique = true;
      $user_id_contact = 0;
      foreach($users as $key=>$value) {
        if($request->input('email') == $value->email) {
          $test_unique = false;
          $user_id_contact = $value->id;
          break;
        }
      }
      if($test_unique) {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $pass = $request->input('password');
        $user->password = bcrypt($pass);
        $user->type = "staff";
        $user->save();
        $staff = new Staff;
        $staff->description = $request->input('description');
        $staff->department = $request->input('department');
        $staff->user_id = $user->id;
        $staff->save();
      } else {
        $staff = new Staff;
        $staff->description = $request->input('description');
        $staff->department = $request->input('department');
        $staff->user_id = $user_id_contact;

    		$staff->save();
      }
    }

    $staff = Staff::all();
    return view('admin.staff.index')
              ->with('staff', $staff);
  }

  public function edit($id) {
    return view('admin.staff.edit')->with('id', $id);
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

  public function destroy($id) {
    $staff = Staff::find($id);
    $user = User::find($staff->user_id);
    if(Auth::user()->type == 'admin'){
      try {
        $staff->user_id = NULL;
        $staff->save();
        $user->delete();
        $staff->delete();
      } catch ( \Illuminate\Database\QueryException $e) {
          var_dump($e->errorInfo );
      }
      $staff = Staff::all();
      return view('admin.staff.index')
                ->with('staff', $staff);
    }else{
      $staff = Staff::all();
      return view('admin.staff.index')
                ->with('staff', $staff);
    }
  }
}
