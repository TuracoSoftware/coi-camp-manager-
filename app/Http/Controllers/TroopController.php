<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Troop;
use App\User;
use App\Scout;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

class TroopController extends Controller
{
  //
  public function __construct() {
     $this->middleware('auth');
  }

  public function index() {

    $troops = 0;

    if(Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff')
      $troops = Troop::all();
    else
      $troops = Troop::where('user_id', Auth::id())
                        ->get();

    $notroop = False;
    if($troops === 0 || count($troops) == 0 || Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff')
      $notroop = True;

    if(Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff'){
      return view('admin.troops.index')
            ->with('troops',$troops)
            ->with('notroop',$notroop);
    }else{
      if(Auth::user()->troop)
		  		$scout = Scout::where('troop_id', Auth::user()->troop->id)
		                    	->get();
		    else
		    	$scout = [];

      return view('troops.index')
            ->with('troops',$troops)
            ->with('notroop',$notroop)
            ->with('scouts',$scout);
    }

  }

  public function addScout($id){
    $troop = Troop::find($id);
    return view('admin.troops.add_scout')
              ->with('troop', $troop);
  }

  public function addScoutUpdate($id, Request $request) {
    $rules = array();

   $current_user = Auth::user();

   $validator = Validator::make($request->all(), $rules);

   if($validator->fails()) {
       return redirect()->back()->withErrors($validator->messages());
   } else {
       $scout = new Scout;

       $scout->firstname = $request->input('firstname');
       $scout->lastname = $request->input('lastname');
       $scout->age = $request->input('age');
       $scout->troop_id = $request->$id;
       $scout->save();
       return redirect()->to('troop');
   }
  }


    public function edit($id){

      $troop = Troop::find($id);


      if($troop) //if troop exists

        if($troop->user == Auth::user() || Auth::user()->type == 'admin' || Auth::user()->type == 'director') // if troop's user is me or im the admin

          if(Auth::user()->type == 'admin' || Auth::user()->type == 'director'){
            return view('admin.troops.edit')
                    ->with('id', $troop->id)
                    ->with('firstname', $troop->scout_master_first_name)
                    ->with('lastname', $troop->scout_master_last_name)
                    ->with('phone', $troop->scout_master_phone)
                    ->with('email', $troop->scout_master_email)
                    ->with('troopnumber', $troop->troop)
                    ->with('council', $troop->council)
                    ->with('week', $troop->week_attending_camp);
          }else{

            return view('troops.edit')
                    ->with('id', $troop->id)
                    ->with('firstname', $troop->scout_master_first_name)
                    ->with('lastname', $troop->scout_master_last_name)
                    ->with('phone', $troop->scout_master_phone)
                    ->with('email', $troop->scout_master_email)
                    ->with('troopnumber', $troop->troop)
                    ->with('council', $troop->council)
                    ->with('week', $troop->week_attending_camp);
          }

      return redirect()->to('troop');

    }

    public function update($id, Request $request)
    {
      $rules = array(
        'firstname'    =>   'required'
      );

      $troop = Troop::find($id);

      if( $troop ){
        if($troop->user == Auth::user() || Auth::user()->type == 'admin' || Auth::user()->type == 'director'){ // if troop's user is me or im the admin

          $validator = Validator::make($request->all(), $rules);

          if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
          } else {
              $troop->troop = $request->input('troopnumber');
              $troop->scout_master_first_name = $request->input('firstname');
              $troop->scout_master_last_name = $request->input('lastname');
              $troop->scout_master_phone = $request->input('phone');
              $troop->scout_master_email = $request->input('email');
              $troop->week_attending_camp = $request->input('week');
              $troop->council = $request->input('council');

              $troop->save();
              return redirect()->to('troop');
          }

        }
      }

    }

    public function create() {

      $current_user = Auth::user();



      //check if user is logged in
      if ( $current_user ){

        if ( $current_user->troop ){

          $troop_id = $current_user->troop->id;

          if(Auth::user()->type == 'admin' || Auth::user()->type == 'director'){
            return redirect('administrator/troop/'.$troop_id.'/edit');
          }else{
            return redirect('troop/'.$troop_id.'/edit');
          }

        }else{

          if(Auth::user()->type == 'admin' || Auth::user()->type == 'director'){
            return view('admin.troops.create');
          }else{
            return view('troops.create');
          }

        }


      }

      return view('login');


    }

    public function store(Request $request) {
      $rules = array(
        'firstname'    =>   'required'
      );

      $current_user = Auth::user();

      //check if user is logged in
      if ( $current_user ){
        if ( !$current_user->troop ){

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
              return redirect()->back()->withErrors($validator->messages());
            } else {
                $troop = new Troop;


                $troop->troop = $request->input('troopnumber');
                $troop->scout_master_first_name = $request->input('firstname');
                $troop->scout_master_last_name = $request->input('lastname');
                $troop->scout_master_phone = $request->input('phone');
                $troop->scout_master_email = $request->input('email');
                $troop->week_attending_camp = $request->input('week');
                $troop->council = $request->input('council');
                if(Auth::user()->type != 'admin')
                  $troop->user_id = Auth::user()->id;

                $troop->save();
                return redirect()->to('troop');
            }
        }
      }

    }



    public function destroy($id) {

      $current_user = Auth::user();
      //check if user is logged in
      if ( $current_user ){

        if ( $current_user->troop ){

          $troop = Troop::find($id);

          $troop_id = $current_user->troop->id;

          if($troop_id == $troop->id || Auth::user()->type == 'admin' || Auth::user()->type == 'director'){

            try {
              $troop->user_id = NULL;
              $troop->save();
              foreach($troop->scouts()->get() as $scout){
                $scout->troop_id = NULL;
                $scout->save();
              }
              $troop->delete();
            } catch ( \Illuminate\Database\QueryException $e) {
                var_dump($e->errorInfo );
            }
            return 'success';
          }else{
            return 'error';
          }
        }else{
          return view('troops.create');
        }
      }
      return view('login');
    }


    public function profile($id) {
    $scout = Scout::where('troop_id', $id)->get();
    $troop = Troop::find($id);

    return view('admin.troops.profile')
        ->with('troop',$troop)
        ->with('scouts',$scout);
    }

}
