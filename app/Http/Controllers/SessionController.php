<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class SessionController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

	public function index() {

    $sessions = Session::all();

    return view('sessions.index')
          ->with('sessions',$sessions);

	}

	public function edit($id){

		$session = Session::find($id);

		if($session) //if scout exists

		  return view('scouts.edit')
		          ->with('id', $scout->id)
		          ->with('firstname', $scout->firstname)
		          ->with('lastname', $scout->lastname)
		          ->with('age', $scout->age)
		          ->with('troop_id', $scout->troop_id);

		return redirect()->to('session');

	}

	public function update($id, Request $request)
    {


    }




	public function create() {

      $current_user = Auth::user();

      //check if user is logged in
      if ( $current_user ){
        return view('sessions.create');
      }

      return view('login');

    }

    public function store(Request $request) {


    }


}
