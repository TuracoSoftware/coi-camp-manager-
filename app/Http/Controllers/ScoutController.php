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

// This class controls the scout functions
class ScoutController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		if(Auth::user()->type == 'admin') {
			$scout = Scout::all(); // gets all scouts
			return view('admin.scouts.index')
		      ->with('scouts',$scout);
		} else {
			if(Auth::user()->troop)
		  	$scout = Scout::where('troop_id', Auth::user()->troop->id)->get(); // gets all scouts inside of the troop
		  else
		  	$scout = [];

			return view('scouts.index')
		    	  			->with('scouts',$scout);
		}
	}

	public function week($id){
		if(Auth::user()->type == 'admin' || Auth::user()->type == 'director'){
			//Get the ID's of the troops for indexing the correct scouts
			$troops = Troop::where('week_attending_camp', $id)->get()->lists('id');
			//Get the troops that week for another table on the admin.scouts.index page
			$troop = Troop::where('week_attending_camp', $id)->get();
			//Get list of classes for the class stat views
			$classes = Sclass::all();
			//Finally, get the scouts from the database
			$scout = Scout::whereIn('troop_id', $troops)->get();
			return view('admin.scouts.index')
									->with('week', $id)
									->with('troops', $troop)
									->with('classes', $classes)
		      				->with('scouts',$scout);
		} else {
			if(Auth::user()->troop) {
				$troops = Troop::where('week_attending_camp', $id)->get()->lists('id');
		  	$scout = Scout::where('troop_id', Auth::user()->troop->id)->whereIn('troop_id', $troops)->get();
		  } else
		    $scout = [];
			return view('scouts.index')
		    	  			->with('scouts',$scout);
		}
	}

	public function search_by_name(Request $request){
		$name = $request->input('name');
		if(Auth::user()->type == 'admin') {
			$scout = Scout::where('firstname', 'LIKE', '%'.$name.'%')->orWhere('lastname', 'LIKE', '%'.$name.'%')->get();
			return view('admin.scouts.index')
		      				->with('scouts',$scout);
		} else {
			if(Auth::user()->troop){
		  	$scout = Scout::where('troop_id', Auth::user()->troop->id)
		  					->where(function($query) use ($name){
	  						$query->where('firstname', 'LIKE', '%'.$name.'%')
	            	->orWhere('lastname', 'LIKE', '%'.$name.'%');})->get();
		  } else {
		    $scout = [];
		    return redirect()->to('scout');
		  }
		  return view('scouts.index')
		      				->with('scouts',$scout);
		}
		return redirect()->to('scout');
	}

	// This method controls the actual registration
	public function schedule($id){

		$scout = Scout::find($id);
		$week = $scout->troop->week_attending_camp;
		if($scout) //if scout exists

			$troop_id = NULL;
			if(Auth::user()->troop){
				$troop_id = Auth::user()->troop->id;
			}

		if($scout->troop_id == $troop_id || Auth::user()->type == 'admin' || Auth::user()->type == 'director')

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

			// Return only the classes a scout is eligable to take
			foreach($sclasses as $key => $val) {
				if($val->min_age > $scout->age){
					unset($sclasses[$key]);
				}
			}


			// These next statements validate a registration
			if(count($sclasses) > 0)
			foreach($sclasses as $sclass) {

				// If the duration is AM Only or AM & PM set AM to the sclass name
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

				// validate the TWilight class registrations
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

			$sclasses_mo912 = Sclass::where('day', 'Monday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_tu912 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_we912 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_th912 = Sclass::where('day', 'Thursday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_fr912 = Sclass::where('day', 'Friday')->whereIn('duration', ['AM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();

			$sclasses_mo25 = Sclass::where('day', 'Monday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_tu25 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_we25 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_th25 = Sclass::where('day', 'Thursday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_fr25 = Sclass::where('day', 'Friday')->whereIn('duration', ['PM Only','AM & PM'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();

			$sclasses_mo79 = Sclass::where('day', 'Monday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_tu79 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_we79 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_th79 = Sclass::where('day', 'Thursday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();
			$sclasses_fr79 = Sclass::where('day', 'Friday')->whereIn('duration', ['Twilight'])->where('min_age', '<=', $scout->age)->orderBy('name', 'asc')->get();


			foreach($sclasses_mo912 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) > $val->size) unset($sclasses_mo912[$key]);
			foreach($sclasses_tu912 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_tu912[$key]);
			foreach($sclasses_we912 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_we912[$key]);
			foreach($sclasses_th912 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_th912[$key]);
			foreach($sclasses_fr912 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) > $val->size) unset($sclasses_fr912[$key]);

			foreach($sclasses_mo25 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_mo25[$key]);
			foreach($sclasses_tu25 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_tu25[$key]);
			foreach($sclasses_we25 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_we25[$key]);
			foreach($sclasses_th25 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_th25[$key]);
			foreach($sclasses_fr25 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_fr25[$key]);

			foreach($sclasses_mo79 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_mo79[$key]);
			foreach($sclasses_tu79 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_tu79[$key]);
			foreach($sclasses_we79 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_we79[$key]);
			foreach($sclasses_th79 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_th79[$key]);
			foreach($sclasses_fr79 as $key => $val)
				if(!$scout->classExists($val->id) )
					if($val->count_scouts_week($week) >= $val->size) unset($sclasses_fr79[$key]);

			// Classes prepared and ready to be sent to the form
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
		return redirect()->to('troop');
	}

	public function edit($id){
		$scout = Scout::find($id);
		$troop_id = NULL;
		if(Auth::user()) {
			if(Auth::user()->type == 'admin' || Auth::user()->type == 'director') {
				if($scout) {
					$troop_id = $scout->troop_id;
				}
			} else
				$troop_id = Auth::user()->troop->id;
		}

		if($scout) //if scout exists
			if($scout->troop_id == $troop_id || Auth::user()->type == 'admin' || Auth::user()->type == 'director')
				if(Auth::user()->type == 'admin'){
					return view('admin.scouts.edit')
		          				->with('id', $scout->id)
		          				->with('firstname', $scout->firstname)
		          				->with('lastname', $scout->lastname)
		          				->with('age', $scout->age)
		          				->with('troop_id', $scout->troop_id);
				} else {
			  	return view('scouts.edit')
			          			->with('id', $scout->id)
			          			->with('firstname', $scout->firstname)
			          			->with('lastname', $scout->lastname)
			          			->with('age', $scout->age)
			          			->with('troop_id', $scout->troop_id);
			}
		return redirect()->to('scout');
	}

	public function update($id, Request $request) {
		$rules = array(
			'firstname'=>'required'
		);
		$scout = Scout::find($id);
    $auth_user_troop_id = '';
		if(Auth::user()->type != 'admin')
			$auth_user_troop_id = Auth::user()->troop->id;
		else
			$auth_user_troop_id = $scout->troop_id;

		if($scout) {
			if($scout->troop_id == $auth_user_troop_id || Auth::user()->type == 'admin') {
			  $validator = Validator::make($request->all(), $rules);
			  if($validator->fails()) {
			    return redirect()->back()->withErrors($validator->messages());
			  } else {
			    $scout->firstname = $request->input('firstname');
			    $scout->lastname = $request->input('lastname');
			    $scout->age = $request->input('age');
			    if(!empty($scout->troop_id)) {
			    	$scout->troop_id = $scout->troop_id;
			    } else {
			    	$scout->troop_id = $request->input('troop_id');
			    }
			    $scout->save();
			    return redirect()->to('troop');
			  }
			}
		}
  }

	public function create() {
    $current_user = Auth::user();
		$troops = Troop::all();
		$maxPos = NULL;
		$max = NULL;
		for($i = 0; $i < count($troops)-1; $i++) {
			$max = $troops[$i]->troop;
			$maxPos = $i;
			for($j = $i+1; $j < count($troops); $j++) {
				if($max < $troops[$j]->troop) {
					$max = $troops[$j]->troop;
					$maxPos = $j;
					$temp = $troops[$i];
					$troops[$i] = $troops[$j];
					$troops[$j] = $temp;
				}
			}
		}
    //check if user is logged in
    if($current_user) {
  		if(Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff') {
				return view('admin.scouts.create')
										->with('troops', $troops);
    	} else {
				if($current_user->troop)
    			return view('scouts.create');
    	}
    }
    return redirect()->to('login');
  }

  public function store(Request $request) {
		$rules = array(
				'firstname'=>'required'
		);
		$current_user = Auth::user();
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
			if(Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff')
				$scout->troop_id = $request->input('troop');
		  $scout->save();
			return redirect()->to('scout/create');
		}
  }

  public function destroy($id) {
    $current_user = Auth::user();
    //check if user is logged in
    if($current_user) {
      $scout = Scout::find($id);
      if($scout)
        if(Auth::user()->troop()->id = $scout->troop_id || Auth::user()->type == 'admin') {
          foreach ($scout->classes as $sclass) {
						$scout->classes()->detach($sclass->id);
					}
          try {
            $scout->delete();
          } catch ( \Illuminate\Database\QueryException $e) {
            var_dump($e->errorInfo );
          }
            return 'success';
        } else {
            return redirect()->to('scout');
        }
    }
    return view('login');
  }
}
