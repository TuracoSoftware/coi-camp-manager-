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
    $users = User::where('type', 'director')->get(); //Gets all directors from the user table
    $director = Director::all(); //Gets all directors from the director table
    $used = False;
    $unused = array();
    $count = 0;
    foreach($users as $key=>$user) {       // Goes through the directors from the
      foreach($director as $key=>$sMem) {  // user table and the director table
        if($sMem->user_id == $user->id) {  // and if there is a user with the type
          $used = True;                    // director, save that user's id into an
          break;                           // array and makes a new director for the
        }                                  // missing one.
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
    if($current_user) { // checks if the user is loged in
      if(Auth::user()->type == 'admin') { // checks if the user is an admin
        return view('admin.director.create');
      }
    }
  }

  public function store(Request $request) {
    $rules = array();                 // checks to see if the form is ready to put
    $current_user = Auth::user();     // in the database
		$validator = Validator::make($request->all(), $rules);
		if($validator->fails()) {
			return redirect()->back()->withErrors($validator->messages());
		} else {
      $users = User::all(); // gets all users
      $test_unique = true;
      $user_id_contact = 0;
      foreach($users as $key=>$value) {                 // goes through the users
        if($request->input('email') == $value->email) { // and sees if any of the users
          $test_unique = false;                         // have the same email as
          $user_id_contact = $value->id;                // the new director
          break;
        }
      }
      if($test_unique) {                             // tests if there is a need
        $user = new User;                            // to make a user with the new
        $user->name = $request->input('name');       // director
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
    return view('admin.director.edit')
                ->with('id', $id);
  }

  public function update($id, Request $request) {
    $director = director::find($id); // finds the director to update
    $user = $director->user; // finds the user account with the director
    $rules = array();
    $validator = Validator::make($request->all(), $rules);
    if($validator->fails()) {
      return redirect()->back()->withErrors($validator->messages());
    } else {
      if($request->input('name')) { // tests if there is a new name to put in
        $user->name = $request->input('name');
      }
      if($request->input('email')) { // tests if there is a new email to put in
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
