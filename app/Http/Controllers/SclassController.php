<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sclass;
use App\Scout;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class SclassController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

	public function index() {

    if(Auth::user()->type == 'admin'){

      $sclass = Sclass::all();

      return view('admin.sclass.index')
          ->with('sclass',$sclass);
    }else{
      return redirect()->to('login');
    }

	}

  public function edit($id){

    $sclass = Sclass::find($id);

    if($sclass) //if scout exists

    if(Auth::user()->type == 'admin' ) // if troop's user is me or im the admin

      return view('admin.sclass.edit')
              ->with('id', $sclass->id)
              ->with('name', $sclass->name)
              ->with('description', $sclass->description)
              ->with('day', $sclass->day)
              ->with('department', $sclass->department)
              ->with('fee', $sclass->fee)
              ->with('duration', $sclass->duration)
              ->with('size', $sclass->size)
              ->with('min_age', $sclass->min_age);

    return redirect()->to('sclass');

  }

	public function update($id, Request $request)
    {
      $rules = array(
        'name'    =>   'required',
        'min_age' =>   'required'
      );

      $sclass = Sclass::find($id);

      if( $sclass ){
        if(Auth::user()->type == 'admin' ){ // if troop's user is me or im the admin

          $validator = Validator::make($request->all(), $rules);

          if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
          } else {
              $sclass->name = $request->input('name');
              $sclass->description = $request->input('description');
              $sclass->min_age = $request->input('min_age');
              $sclass->day = $request->input('day');
              $sclass->department = $request->input('department');
              $sclass->fee = $request->input('fee');
              $sclass->size = $request->input('size');
              $sclass->duration = $request->input('duration');

              $sclass->save();
              return redirect()->to('sclass');
          }

        }
        return redirect()->to('/');
      }

      return redirect()->to('sclass');

    }





	public function create() {

      $current_user = Auth::user();

      //check if user is logged in
      if ( $current_user ){

        if ( $current_user->type == 'admin' ){

          return view('admin.sclass.create');

        }

      }

      return view('login');

    }

    public function store(Request $request) {
  		$rules = array(
  		'name'    =>   'required',
      'min_age' =>   'required'
  		);

  		$current_user = Auth::user();

      if($current_user)
        if($current_user->type != 'admin')
          return redirect()->to('/');

  		//check if user is logged in
      if($current_user){
    		$validator = Validator::make($request->all(), $rules);

    		if($validator->fails()) {
    		  return redirect()->back()->withErrors($validator->messages());
    		} else {
    		    $sclass = new Sclass;

    		    $sclass->name = $request->input('name');
    		    $sclass->description = $request->input('description');
            $sclass->min_age = $request->input('min_age');
            $sclass->department = $request->input('department');
            $sclass->fee = $request->input('fee');
            $sclass->day = $request->input('day');
            $sclass->size = $request->input('size');
    		    $sclass->duration = $request->input('duration');

    		    $sclass->save();
    		    return redirect()->to('sclass');
    		}

      }

    }

    public function destroy($id) {
      
      $current_user = Auth::user();
      //check if user is logged in
      if ( $current_user ){

          $sclass = Sclass::find($id);
          if($sclass)
          if(Auth::user()->type == 'admin'){

            try {
              $sclass->delete();
            } catch ( \Illuminate\Database\QueryException $e) {
                var_dump($e->errorInfo );
            }
            return 'success';
          }else{
            return redirect()->to('/');
          }

      }
      return view('login');
    }


}
