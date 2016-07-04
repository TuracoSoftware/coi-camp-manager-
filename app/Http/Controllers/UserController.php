<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

  public function index() {
    $users = User::all();
    return view('admin.users.index')
                ->with('users', $users);
  }

  public function create() {
    $current_user = Auth::user();
    //check if user is logged in
    if($current_user) {
      if(Auth::user()->type == 'admin') {
        return view('admin.users.create');
      }
    }
  }

  public function destroy($id) {
    $current_user = Auth::user();
    //check if user is logged in
    if($current_user) {
      $user = User::find($id);
      if($user)
        if(Auth::user()->type == 'admin') {
          try {
            $user->delete();
          } catch( \Illuminate\Database\QueryException $e) {
              var_dump($e->errorInfo );
          }
          return view('admin.users.index');
        } else {
          return redirect()->to('scout');
        }
    }
    return view('login');
  }

  public function store(Request $request) {
    $rules = array(
      'name'  =>  'required'
    );
    $current_user = Auth::user();
		$validator = Validator::make($request->all(), $rules);
		if($validator->fails()) {
		  return redirect()->back()->withErrors($validator->messages());
		} else {
		  $user = new User;
		  $user->name = $request->input('name');
		  $user->email = $request->input('email');
      $pass = $request->input('password');
		  $user->password = bcrypt($pass);
      $user->type = $request->input('type');
		  $user->save();
		}
    $users = User::all();
    return view('admin.users.index')
                ->with('users', $users);
  }

  public function edit($id) {
    return view('admin.users.edit')->with('id', $id);
  }

  public function update($id, Request $request) {
    $user = User::find($id);
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
      $users = User::all();
      return view('admin.users.index')
                  ->with('users', $users);
    }
  }
}
