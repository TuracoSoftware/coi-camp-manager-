<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Director;
use Auth;
use Validator;

class DirectorController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

  public function index() {
    $users = User::where('type', 'director')->get();
    $director = Director::all();
    $used = False;
    $unused = array();
    $count = 0;
    foreach($users as $key=>$user) {
      foreach($director as $key=>$sMem) {
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
      $sMem = new Director;
      $sMem->user_id = $val;
      $sMem->save();
    }
    $director = Director::all();
    if(Auth::user()->type == 'admin') {
      return view('admin.director.index')->with('director', $director);
    } elseif(Auth::user()->type == 'director') {
      return view('director.index')->with('director', $director);
    } else {
      return view('welcome');
    }
  }

  public function create() {
    $current_user = Auth::user();
    if ( $current_user ){
      if(Auth::user()->type == 'admin'){
        return view('admin.director.create');
      }
    }
  }

  public function store(Request $request) {
    $rules = array();
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
        $user->type = "director";
        $user->save();
        $director = new Director;
        $director->description = $request->input('description');
        $director->department = $request->input('department');
        $director->user_id = $user->id;
        $director->save();
      } else {
        $director = new Director;
        $director->description = $request->input('description');
        $director->department = $request->input('department');
        $director->user_id = $user_id_contact;

    		$director->save();
      }
    }

    $director = Director::all();
    return view('admin.director.index')
              ->with('director', $director);
  }

  public function edit($id) {
    return view('admin.director.edit')->with('id', $id);
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
        return view('admin.director.director');
        }
    }*/
    $director = director::find($id);
    $user = $director->user;
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
          $director->description = $request->input('description');
        }
        if($request->input('department')) {
          $director->department = $request->input('department');
        }
        $director->save();

        $director = director::all();
        return view('admin.director.index')
                  ->with('director', $director);
    }
  }
}
