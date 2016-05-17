<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

  public function display_all() {
    $users = User::all();
    return view('admin.users.users')
              ->with('users', $users);
  }

  public function create() {
    $current_user = Auth::user();
    //check if user is logged in
    if ( $current_user ){
        if(Auth::user()->type == 'admin'){
          return view('admin.troops.create');
        }else{
          return view('troops.create');
        }
      }
    return view('login');
  }

  public function store(Request $request) {
    $rules = array(
      'name'  =>  'required'
    );
    $current_user = Auth::user();
		//check if user is logged in
		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
		  	return redirect()->back()->withErrors($validator->messages());
		} else {
		    $user = new User;

		    $user->name = $request->input('name');
		    $user->email = $request->input('email');
		    $user->password = $request->input(bcrypt('password'));

		    $user->save();
		    return view('admin.users.users');
		}

  }
}
