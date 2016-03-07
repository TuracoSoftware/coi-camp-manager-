<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scout;
use App\Sclass;
use App\Troop;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class ScoutController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		if(Auth::user()->type == 'admin'){
			$scout = Scout::all();

			// return view('scouts.index')
		 //      ->with('scouts',$scout);

			return view('admin.scouts.index')
		      ->with('scouts',$scout);

		}else{
			if(Auth::user()->troop)
		  		$scout = Scout::where('troop_id', Auth::user()->troop->id)
		                    	->get();
		    else
		    	$scout = [];

			return view('scouts.index')
		    	  ->with('scouts',$scout);
		    
		}


	}

	public function week($id){

		if(Auth::user()->type == 'admin'){

			$troops = Troop::where('week_attending_camp', $id)->get()->lists('id');

			$scout = Scout::whereIn('troop_id', $troops)->get();

			return view('admin.scouts.index')
		      ->with('scouts',$scout);

		}else{
			if(Auth::user()->troop){

				$troops = Troop::where('week_attending_camp', $id)->get()->lists('id');

		  		$scout = Scout::where('troop_id', Auth::user()->troop->id)
		                    	->whereIn('troop_id', $troops)
		                    	->get();
		    }else
		    	$scout = [];

			return view('scouts.index')
		    	  ->with('scouts',$scout);
		    
		}

	}

	public function search_by_name(Request $request){
		
		$name = $request->input('name');

		if(Auth::user()->type == 'admin'){
			$scout = Scout::where('firstname', 'LIKE', '%'.$name.'%')->orWhere('lastname', 'LIKE', '%'.$name.'%')->get();
			return view('admin.scouts.index')
		      ->with('scouts',$scout);
		}else{
			if(Auth::user()->troop){
		  		$scout = Scout::where('troop_id', Auth::user()->troop->id)
		  						->where(function($query) use ($name){
	  									$query->where('firstname', 'LIKE', '%'.$name.'%')
	                    				->orWhere('lastname', 'LIKE', '%'.$name.'%');
		  						})->get();
		    }else{
		    	$scout = [];
		    	return redirect()->to('scout');
		    }
		    return view('scouts.index')
		      ->with('scouts',$scout);

		}

		return redirect()->to('scout');


	}

	public function schedule($id){

		$scout = Scout::find($id);
		if($scout) //if scout exists

			$troop_id = NULL;
			if(Auth::user()->troop){
				$troop_id = Auth::user()->troop->id;
			}

		if($scout->troop_id == $troop_id || Auth::user()->type == 'admin' ) // if troop's user is me or im the admin

			$mo912 = NULL;
			$tu912 = NULL;
			$we912 = NULL;
			$th912 = NULL;
			$fr912 = NULL;

			$mo25 = NULL;
			$tu25 = NULL;
			$we25 = NULL;
			$th25 = NULL;
			$fr25 = NULL;

			$mo79 = NULL;
			$tu79 = NULL;
			$we79 = NULL;
			$th79 = NULL;
			$fr79 = NULL;

			$sclasses = $scout->classes;
			
			//this foreach remove all classes that have min_age > than scout's age
			foreach($sclasses as $key => $val) {
				if($val->min_age > $scout->age){
					unset($sclasses[$key]);
				}
			}
			/*foreach($sclasses as $key => $val) {
				if($val->size < $val->scouts()->count() ){
					unset($sclasses[$key]);
				}
			}*/


			if(count($sclasses) > 0)
			foreach($sclasses as $sclass) {
				if($sclass->day == 'Monday' && ($sclass->duration == 'AM Only' || $sclass->duration == 'AM & PM')){
					$mo912 = $sclass->name;
				}
				if($sclass->day == 'Tuesday' && ($sclass->duration == 'AM Only' || $sclass->duration == 'AM & PM')){
					$tu912 = $sclass->name;
				}
				if($sclass->day == 'Wednesday' && ($sclass->duration == 'AM Only' || $sclass->duration == 'AM & PM')){
					$we912 = $sclass->name;
				}
				if($sclass->day == 'Thursday' && ($sclass->duration == 'AM Only' || $sclass->duration == 'AM & PM')){
					$th912 = $sclass->name;
				}
				if($sclass->day == 'Friday' && ($sclass->duration == 'AM Only' || $sclass->duration == 'AM & PM')){
					$fr912 = $sclass->name;
				}


				if($sclass->day == 'Monday' && ($sclass->duration == 'PM Only' || $sclass->duration == 'AM & PM')){
					if( $sclass->duration == 'AM & PM' )
						$mo25 = $sclass->name;
					else if( $sclass->duration == 'PM Only' && $mo25 == NULL)
						$mo25 = $sclass->name;
				}
				if($sclass->day == 'Tuesday' && ($sclass->duration == 'PM Only' || $sclass->duration == 'AM & PM')){
					if( $sclass->duration == 'AM & PM' )
						$tu25 = $sclass->name;
					else if( $sclass->duration == 'PM Only' && $tu25 == NULL)
						$tu25 = $sclass->name;
				}
				if($sclass->day == 'Wednesday' && ($sclass->duration == 'PM Only' || $sclass->duration == 'AM & PM')){
					if( $sclass->duration == 'AM & PM' )
						$we25 = $sclass->name;
					else if( $sclass->duration == 'PM Only' && $we25 == NULL)
						$we25 = $sclass->name;
				}
				if($sclass->day == 'Thursday' && ($sclass->duration == 'PM Only' || $sclass->duration == 'AM & PM')){
					if( $sclass->duration == 'AM & PM' )
						$th25 = $sclass->name;
					else if( $sclass->duration == 'PM Only' && $th25 == NULL)
						$th25 = $sclass->name;
				}
				if($sclass->day == 'Friday' && ($sclass->duration == 'PM Only' || $sclass->duration == 'AM & PM')){
					if( $sclass->duration == 'AM & PM' )
						$fr25 = $sclass->name;
					else if( $sclass->duration == 'PM Only' && $fr25 == NULL)
						$fr25 = $sclass->name;
				}


				if($sclass->day == 'Monday' && $sclass->duration == 'Twilight'){
					$mo79 = $sclass->name;
				}
				if($sclass->day == 'Tuesday' && $sclass->duration == 'Twilight'){
					$tu79 = $sclass->name;
				}
				if($sclass->day == 'Wednesday' && $sclass->duration == 'Twilight'){
					$we79 = $sclass->name;
				}
				if($sclass->day == 'Thursday' && $sclass->duration == 'Twilight'){
					$th79 = $sclass->name;
				}
				if($sclass->day == 'Friday' && $sclass->duration == 'Twilight'){
					$fr79 = $sclass->name;
				}


			}


			$sclasses_mo912 = Sclass::where('day', 'Monday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_tu912 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_we912 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_th912 = Sclass::where('day', 'Thursday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_fr912 = Sclass::where('day', 'Friday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();

			$sclasses_mo25 = Sclass::where('day', 'Monday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_tu25 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_we25 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_th25 = Sclass::where('day', 'Thursday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_fr25 = Sclass::where('day', 'Friday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->get();

			$sclasses_mo79 = Sclass::where('day', 'Monday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_tu79 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_we79 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_th79 = Sclass::where('day', 'Thursday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->get();
			$sclasses_fr79 = Sclass::where('day', 'Friday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->get();

			$context = array(
				'mo912' => $mo912,
				'tu912' => $tu912,
				'we912' => $we912,
				'th912' => $th912,
				'fr912' => $fr912,

				'mo25' => $mo25,
				'tu25' => $tu25,
				'we25' => $we25,
				'th25' => $th25,
				'fr25' => $fr25,

				'mo79' => $mo79,
				'tu79' => $tu79,
				'we79' => $we79,
				'th79' => $th79,
				'fr79' => $fr79,

				'sclasses_mo912' => $sclasses_mo912,
				'sclasses_tu912' => $sclasses_tu912,
				'sclasses_we912' => $sclasses_we912,
				'sclasses_th912' => $sclasses_th912,
				'sclasses_fr912' => $sclasses_fr912,

				'sclasses_mo25' => $sclasses_mo25,
				'sclasses_tu25' => $sclasses_tu25,
				'sclasses_we25' => $sclasses_we25,
				'sclasses_th25' => $sclasses_th25,
				'sclasses_fr25' => $sclasses_fr25,

				'sclasses_mo79' => $sclasses_mo79,
				'sclasses_tu79' => $sclasses_tu79,
				'sclasses_we79' => $sclasses_we79,
				'sclasses_th79' => $sclasses_th79,
				'sclasses_fr79' => $sclasses_fr79,

			);

			if(Auth::user()->type == 'admin'){

				return view('admin.scouts.schedule', $context)
		          ->with('id', $scout->id)
		          ->with('scout', $scout);

			}else{

			  	return view('scouts.schedule', $context)
			          ->with('id', $scout->id)
			          ->with('scout', $scout);
			}


		return redirect()->to('scout');

	}

	public function update_schedule($id, Request $request){

		$scout = Scout::find($id);

		foreach ($scout->classes as $sclass){
			$scout->classes()->detach($sclass->id);
		}

		/*saving only 9 - 12 */

		$mo912 = $request->input('mo912');
		
		if($mo912 != 'Free'){
			$scout->classes()->attach($mo912);
		}

		$tu912 = $request->input('tu912');
		
		if($tu912 != 'Free'){
			$scout->classes()->attach($tu912);
		}

		$we912 = $request->input('we912');
		
		if($we912 != 'Free'){
			$scout->classes()->attach($we912);
		}

		$th912 = $request->input('th912');
		
		if($th912 != 'Free'){
			$scout->classes()->attach($th912);
		}

		$fr912 = $request->input('fr912');
		
		if($fr912 != 'Free'){
			$scout->classes()->attach($fr912);
		}
		/*END saving only 9 - 12 */



		/*saving only 2 - 5 */

		$mo25 = $request->input('mo25');
		
		if($mo25 != 'Free'){
			$scout->classes()->attach($mo25);
		}

		$tu25 = $request->input('tu25');
		
		if($tu25 != 'Free'){
			$scout->classes()->attach($tu25);
		}

		$we25 = $request->input('we25');
		
		if($we25 != 'Free'){
			$scout->classes()->attach($we25);
		}

		$th25 = $request->input('th25');
		
		if($th25 != 'Free'){
			$scout->classes()->attach($th25);
		}

		$fr25 = $request->input('fr25');
		
		if($fr25 != 'Free'){
			$scout->classes()->attach($fr25);
		}
		/*END saving only 2 - 5 */



		/*saving only 7 - 9 */

		$mo79 = $request->input('mo79');
		
		if($mo79 != 'Free'){
			$scout->classes()->attach($mo79);
		}

		$tu79 = $request->input('tu79');
		
		if($tu79 != 'Free'){
			$scout->classes()->attach($tu79);
		}

		$we79 = $request->input('we79');
		
		if($we79 != 'Free'){
			$scout->classes()->attach($we79);
		}

		$th79 = $request->input('th79');
		
		if($th79 != 'Free'){
			$scout->classes()->attach($th79);
		}

		$fr79 = $request->input('fr79');
		
		if($fr79 != 'Free'){
			$scout->classes()->attach($fr79);
		}
		/*END saving only 2 - 5 */


		return redirect()->to('scout');

	}


	public function edit($id){

		$scout = Scout::find($id);

		$troop_id = NULL;
		if(Auth::user()) {
			if(Auth::user()->type == 'admin'){
				if($scout){
					$troop_id = $scout->troop_id;
				}
			}else
				$troop_id = Auth::user()->troop->id;
		}


		if($scout) //if scout exists

		if($scout->troop_id == $troop_id || Auth::user()->type == 'admin' ) // if troop's user is me or im the admin

			if(Auth::user()->type == 'admin'){

				return view('admin.scouts.edit')
		          ->with('id', $scout->id)
		          ->with('firstname', $scout->firstname)
		          ->with('lastname', $scout->lastname)
		          ->with('age', $scout->age)
		          ->with('troop_id', $scout->troop_id);

			}else{

			  	return view('scouts.edit')
			          ->with('id', $scout->id)
			          ->with('firstname', $scout->firstname)
			          ->with('lastname', $scout->lastname)
			          ->with('age', $scout->age)
			          ->with('troop_id', $scout->troop_id);
			}

		return redirect()->to('scout');

	}

	public function update($id, Request $request)
    {
		$rules = array(
		'firstname'    =>   'required'
		);

		$scout = Scout::find($id);

      	$auth_user_troop_id = '';
		if(Auth::user()->type != 'admin')
			$auth_user_troop_id = Auth::user()->troop->id;
		else
			$auth_user_troop_id = $scout->troop_id;

		if( $scout ){
			if($scout->troop_id == $auth_user_troop_id || Auth::user()->type == 'admin' ){ // if troop's user is me or im the admin

			  $validator = Validator::make($request->all(), $rules);

			  if($validator->fails()) {
			    return redirect()->back()->withErrors($validator->messages());
			  } else {
			      $scout->firstname = $request->input('firstname');
			      $scout->lastname = $request->input('lastname');
			      $scout->age = $request->input('age');
			      if(!empty($scout->troop_id)){
			      	$scout->troop_id = $scout->troop_id;
			      }else{
			      	$scout->troop_id = $request->input('troop_id');
			      }
			      $scout->save();
			      return redirect()->to('scout');
			  }

			}
		}

    }

	public function create() {

      $current_user = Auth::user();

      //check if user is logged in
      if ( $current_user ){



    	if(Auth::user()->type == 'admin'){
      		return view('admin.scouts.create');
      	}else{
      		if ( $current_user->troop )
      			return view('scouts.create');
      	}



      }
      return redirect()->to('login');
      // return view('login');

    }

    public function store(Request $request) {
		$rules = array(
		'firstname'    =>   'required'
		);

		$current_user = Auth::user();

		//check if user is logged in


		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
		  	return redirect()->back()->withErrors($validator->messages());
		} else {
		    $scout = new Scout;

		    $scout->firstname = $request->input('firstname');
		    $scout->lastname = $request->input('lastname');
		    $scout->age = $request->input('age');
		    if(Auth::user()->type != 'admin')
		    	$scout->troop_id = Auth::user()->troop->id;

		    $scout->save();
		    return redirect()->to('scout');
		}

    }


    public function destroy($id) {
      
      $current_user = Auth::user();
      //check if user is logged in
      if ( $current_user ){

          $scout = Scout::find($id);
          if($scout)
          if(Auth::user()->troop()->id = $scout->troop_id || Auth::user()->type == 'admin'){


          	foreach ($scout->classes as $sclass){
				$scout->classes()->detach($sclass->id);
			}

            try {
              $scout->delete();
            } catch ( \Illuminate\Database\QueryException $e) {
                var_dump($e->errorInfo );
            }
            return 'success';
          }else{
            return redirect()->to('scout');
          }

      }
      return view('login');
    }


}
