<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Staff;
use Validator;
use App\Scout;
use App\Sclass;
use App\MeritBadge;
use App\Requirement;
use App\Requirement_started;
use App\MeritBadgeStarted;

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
    if(Auth::user()->type == 'admin' || Auth::user()->type == 'director') {
      return view('admin.staff.index')->with('staff', $staff);
    } elseif(Auth::user()->type == 'staff') {
      return view('staff.index')->with('staff', $staff);
    } else {
      return view('welcome');
    }
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

  public function roster($id){
    if(Auth::user()->type == 'staff') {
      $staff = Staff::find(Auth::user()->id);
    }

    return view('staff.roster')
        ->with('week', $id)
        ->with('classes', $classes)
        ->with('scouts', $staff);
  }

  public function classes($week) {
    $user = User::find(Auth::user()->id);
    $staffs = Staff::all();
    $staff = NULL;
    foreach($staffs as $key=>$value) {
      if($value->user_id = $user->id) {
        $staff = Staff::find($value->id);
      }
    }
    $classes = NULL;
    if($week == 1) {
      $classes = $staff->classes1;
    } elseif($week == 2) {
      $classes = $staff->classes2;
    } elseif($week == 3) {
      $classes = $staff->classes3;
    } elseif($week == 4) {
      $classes = $staff->classes4;
    } elseif($week == 5) {
      $classes = $staff->classes5;
    } elseif($week == 6) {
      $classes = $staff->classes6;
    } elseif($week == 7) {
      $classes = $staff->classes7;
    }

    return view('staff.classes')
            ->with('classes', $classes)
            ->with('week', $week);
  }

  public function advancement($class_id, $week) {
    $scouts_all = Scout::all();
    $classss = Sclass::find($class_id);
    $scouts = NULL;
    foreach($scouts_all as $key=>$scout) {
      if($scout->troop['week_attending_camp'] == $week) {
        $scout_classes = $scout->classes;
        foreach($scout_classes as $key=>$class) {
          if($class->id == $class_id) {
            $scouts[] = $scout;
          }
        }
      }
    }
    $meritB = NULL;
    $meritBs = MeritBadge::all();
    $class_name = substr(strtoupper($classss->name), 0,3);
    foreach($meritBs as $key=>$val) {
      if($class_name == substr(strtoupper($val->name), 0,3))
      {
        $meritB = $val;
        break;
      }
    }

    $requirements_all = Requirement::all();
    $requirements = NULL;
    foreach($requirements_all as $key=>$val) {
      if($val->meritB_id == $meritB->id)
      {
        $requirements[] = $val;
      }
    }
    array_unique($scouts);
    return view('staff.advancement')
            ->with('scouts', $scouts)
            ->with('week', $week)
            ->with('class', $classss)
            ->with('meritB', $meritB)
            ->with('requirements', $requirements);
  }

  public function input(Request $request) {
    $reqs = Requirement::where('meritB_id', $request->input('meritB'))->get();
    for($i = 0; $i<100; $i++) {
      for($j = 0; $j<100; $j++) {
        if($request->input('scout'.strval($i).'req'.strval($j))) {
          $req_pulled = Requirement::find($j);
          if(MeritBadgeStarted::where('scout_id', $i)->get() == "[]") {
            $meritB_started = new MeritBadgeStarted;
            $meritB_started->scout_id = $i;
            $meritB_started->meritbadge_id = $request->input('meritB');
            $meritB_started->save();
            foreach($reqs as $key=>$req) {
              $req_s = new Requirement_started;
              $req_s->meritB_id = $meritB_started->id;
              $req_s->title_req = $req->title_req;
              if($req->title_req == $req_pulled->title_req) {
                $req_s->test_if_complete = 1;
              } else {
                $req_s->test_if_complete = 0;
              }
              $req_s->save();
            }
          } else {
            $meritB = MeritBadgeStarted::where('scout_id', $i)->get();
            $reqs_s = Requirement_started::where('meritbadge_id', $meritB[0]->id);
            foreach($reqs_s as $key=>$req_S) {
              if($req_s->title_req == $req_pulled->title_req && $val->test_if_complete == 0) {
                $req_s->test_if_complete = 1;
              }
            }
          }
        }
      }
    }
  }

  public function schedule($id, $week) {
    $staff = Staff::find($id);

    if(Auth::user()->type == 'admin' || Auth::user()->type == 'director')
    {
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
      if($week == '1') {
      $sclasses = $staff->classes1;
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

				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
				* if a class is all day a staff gets registered all day.
				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
				* are loaded dynamically from value a user sets so that in the future other camps can add their
				* own constraints.
				*/
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
    }elseif ($week == '2') {
        $sclasses = $staff->classes2;
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

  				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
  				* if a class is all day a staff gets registered all day.
  				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
  				* are loaded dynamically from value a user sets so that in the future other camps can add their
  				* own constraints.
  				*/
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
      }elseif ($week == '3') {
        $sclasses = $staff->classes3;
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

  				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
  				* if a class is all day a staff gets registered all day.
  				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
  				* are loaded dynamically from value a user sets so that in the future other camps can add their
  				* own constraints.
  				*/
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
      }elseif ($week == '4') {
        $sclasses = $staff->classes4;
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

  				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
  				* if a class is all day a staff gets registered all day.
  				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
  				* are loaded dynamically from value a user sets so that in the future other camps can add their
  				* own constraints.
  				*/
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
      }elseif ($week == '5') {
        $sclasses = $staff->classes5;
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

  				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
  				* if a class is all day a staff gets registered all day.
  				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
  				* are loaded dynamically from value a user sets so that in the future other camps can add their
  				* own constraints.
  				*/
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
      }elseif ($week == '6') {
        $sclasses = $staff->classes6;
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

  				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
  				* if a class is all day a staff gets registered all day.
  				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
  				* are loaded dynamically from value a user sets so that in the future other camps can add their
  				* own constraints.
  				*/
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
      }elseif ($week == '7') {
        $sclasses = $staff->classes7;
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

  				/* If the duration is PM only or AM & PM set to sclass. Validate and make sure that
  				* if a class is all day a staff gets registered all day.
  				* TODO: The previous two functions should be updated so class contraints such as AM, AM & PM
  				* are loaded dynamically from value a user sets so that in the future other camps can add their
  				* own constraints.
  				*/
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
      }

      $sclasses_mo912 = Sclass::where('day', 'Monday')->whereIn('duration', ['AM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_tu912 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['AM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_we912 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['AM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_th912 = Sclass::where('day', 'Thursday')->whereIn('duration', ['AM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_fr912 = Sclass::where('day', 'Friday')->whereIn('duration', ['AM Only','AM & PM'])->orderBy('name', 'asc')->get();

			$sclasses_mo25 = Sclass::where('day', 'Monday')->whereIn('duration', ['PM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_tu25 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['PM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_we25 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['PM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_th25 = Sclass::where('day', 'Thursday')->whereIn('duration', ['PM Only','AM & PM'])->orderBy('name', 'asc')->get();
			$sclasses_fr25 = Sclass::where('day', 'Friday')->whereIn('duration', ['PM Only','AM & PM'])->orderBy('name', 'asc')->get();

			$sclasses_mo79 = Sclass::where('day', 'Monday')->whereIn('duration', ['Twilight'])->orderBy('name', 'asc')->get();
			$sclasses_tu79 = Sclass::where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->orderBy('name', 'asc')->get();
			$sclasses_we79 = Sclass::where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->orderBy('name', 'asc')->get();
			$sclasses_th79 = Sclass::where('day', 'Thursday')->whereIn('duration', ['Twilight'])->orderBy('name', 'asc')->get();
			$sclasses_fr79 = Sclass::where('day', 'Friday')->whereIn('duration', ['Twilight'])->orderBy('name', 'asc')->get();

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

			if(Auth::user()->type == 'admin' || Auth::user()->type == 'director'){
				return view('admin.staff.schedule', $context)
		          ->with('id', $staff->id)
		          ->with('staff', $staff)
              ->with('week', $week);
			}
    }
    return redirect()->to('home');
  }

  public function update_schedule($id, Request $request){

		$staff = Staff::find($id);
    $week = $request->input('week');

    if($week == '1') {
      foreach ($staff->classes1 as $key=>$sclass){
        $staff->classes1()->detach($sclass->id);
      }

		$mo912 = $request->input('mo912');
		if($mo912 != 'Free'){
      $staff->classes1()->attach($mo912);
		}
		$tu912 = $request->input('tu912');
		if($tu912 != 'Free'){
			$staff->classes1()->attach($tu912);
		}
		$we912 = $request->input('we912');
		if($we912 != 'Free'){
			$staff->classes1()->attach($we912);
		}
		$th912 = $request->input('th912');
		if($th912 != 'Free'){
			$staff->classes1()->attach($th912);
		}
		$fr912 = $request->input('fr912');
		if($fr912 != 'Free'){
			$staff->classes1()->attach($fr912);
		}

		$mo25 = $request->input('mo25');
		if($mo25 != 'Free'){
			$staff->classes1()->attach($mo25);
		}
		$tu25 = $request->input('tu25');
		if($tu25 != 'Free'){
			$staff->classes1()->attach($tu25);
		}
		$we25 = $request->input('we25');
		if($we25 != 'Free'){
			$staff->classes1()->attach($we25);
		}
		$th25 = $request->input('th25');
		if($th25 != 'Free'){
			$staff->classes1()->attach($th25);
		}
		$fr25 = $request->input('fr25');
		if($fr25 != 'Free'){
			$staff->classes1()->attach($fr25);
		}

		$mo79 = $request->input('mo79');
		if($mo79 != 'Free'){
			$staff->classes1()->attach($mo79);
		}
		$tu79 = $request->input('tu79');
		if($tu79 != 'Free'){
			$staff->classes1()->attach($tu79);
		}
		$we79 = $request->input('we79');
		if($we79 != 'Free'){
			$staff->classes1()->attach($we79);
		}
		$th79 = $request->input('th79');
		if($th79 != 'Free'){
			$staff->classes1()->attach($th79);
		}
		$fr79 = $request->input('fr79');
		if($fr79 != 'Free'){
			$staff->classes1()->attach($fr79);
		}
  }elseif ($week == '2') {
      foreach ($staff->classes2 as $key=>$sclass){
        $staff->classes2()->detach($sclass->id);
      }

      $mo912 = $request->input('mo912');
  		if($mo912 != 'Free'){
        $staff->classes2()->attach($mo912);
  		}
  		$tu912 = $request->input('tu912');
  		if($tu912 != 'Free'){
  			$staff->classes2()->attach($tu912);
  		}
  		$we912 = $request->input('we912');
  		if($we912 != 'Free'){
  			$staff->classes2()->attach($we912);
  		}
  		$th912 = $request->input('th912');
  		if($th912 != 'Free'){
  			$staff->classes2()->attach($th912);
  		}
  		$fr912 = $request->input('fr912');
  		if($fr912 != 'Free'){
  			$staff->classes2()->attach($fr912);
  		}

  		$mo25 = $request->input('mo25');
  		if($mo25 != 'Free'){
  			$staff->classes2()->attach($mo25);
  		}
  		$tu25 = $request->input('tu25');
  		if($tu25 != 'Free'){
  			$staff->classes2()->attach($tu25);
  		}
  		$we25 = $request->input('we25');
  		if($we25 != 'Free'){
  			$staff->classes2()->attach($we25);
  		}
  		$th25 = $request->input('th25');
  		if($th25 != 'Free'){
  			$staff->classes2()->attach($th25);
  		}
  		$fr25 = $request->input('fr25');
  		if($fr25 != 'Free'){
  			$staff->classes2()->attach($fr25);
  		}

  		$mo79 = $request->input('mo79');
  		if($mo79 != 'Free'){
  			$staff->classes2()->attach($mo79);
  		}
  		$tu79 = $request->input('tu79');
  		if($tu79 != 'Free'){
  			$staff->classes2()->attach($tu79);
  		}
  		$we79 = $request->input('we79');
  		if($we79 != 'Free'){
  			$staff->classes2()->attach($we79);
  		}
  		$th79 = $request->input('th79');
  		if($th79 != 'Free'){
  			$staff->classes2()->attach($th79);
  		}
  		$fr79 = $request->input('fr79');
  		if($fr79 != 'Free'){
  			$staff->classes2()->attach($fr79);
  		}
    }elseif ($week == '3') {
      foreach ($staff->classes3 as $key=>$sclass){
        $staff->classes3()->detach($sclass->id);
      }

      $mo912 = $request->input('mo912');
  		if($mo912 != 'Free'){
        $staff->classes3()->attach($mo912);
  		}
  		$tu912 = $request->input('tu912');
  		if($tu912 != 'Free'){
  			$staff->classes3()->attach($tu912);
  		}
  		$we912 = $request->input('we912');
  		if($we912 != 'Free'){
  			$staff->classes3()->attach($we912);
  		}
  		$th912 = $request->input('th912');
  		if($th912 != 'Free'){
  			$staff->classes3()->attach($th912);
  		}
  		$fr912 = $request->input('fr912');
  		if($fr912 != 'Free'){
  			$staff->classes3()->attach($fr912);
  		}

  		$mo25 = $request->input('mo25');
  		if($mo25 != 'Free'){
  			$staff->classes3()->attach($mo25);
  		}
  		$tu25 = $request->input('tu25');
  		if($tu25 != 'Free'){
  			$staff->classes3()->attach($tu25);
  		}
  		$we25 = $request->input('we25');
  		if($we25 != 'Free'){
  			$staff->classes3()->attach($we25);
  		}
  		$th25 = $request->input('th25');
  		if($th25 != 'Free'){
  			$staff->classes3()->attach($th25);
  		}
  		$fr25 = $request->input('fr25');
  		if($fr25 != 'Free'){
  			$staff->classes3()->attach($fr25);
  		}

  		$mo79 = $request->input('mo79');
  		if($mo79 != 'Free'){
  			$staff->classes3()->attach($mo79);
  		}
  		$tu79 = $request->input('tu79');
  		if($tu79 != 'Free'){
  			$staff->classes3()->attach($tu79);
  		}
  		$we79 = $request->input('we79');
  		if($we79 != 'Free'){
  			$staff->classes3()->attach($we79);
  		}
  		$th79 = $request->input('th79');
  		if($th79 != 'Free'){
  			$staff->classes3()->attach($th79);
  		}
  		$fr79 = $request->input('fr79');
  		if($fr79 != 'Free'){
  			$staff->classes3()->attach($fr79);
  		}
    }elseif ($week == '4') {
      foreach ($staff->classes4 as $key=>$sclass){
        $staff->classes4()->detach($sclass->id);
      }

      $mo912 = $request->input('mo912');
  		if($mo912 != 'Free'){
        $staff->classes4()->attach($mo912);
  		}
  		$tu912 = $request->input('tu912');
  		if($tu912 != 'Free'){
  			$staff->classes4()->attach($tu912);
  		}
  		$we912 = $request->input('we912');
  		if($we912 != 'Free'){
  			$staff->classes4()->attach($we912);
  		}
  		$th912 = $request->input('th912');
  		if($th912 != 'Free'){
  			$staff->classes4()->attach($th912);
  		}
  		$fr912 = $request->input('fr912');
  		if($fr912 != 'Free'){
  			$staff->classes4()->attach($fr912);
  		}

  		$mo25 = $request->input('mo25');
  		if($mo25 != 'Free'){
  			$staff->classes4()->attach($mo25);
  		}
  		$tu25 = $request->input('tu25');
  		if($tu25 != 'Free'){
  			$staff->classes4()->attach($tu25);
  		}
  		$we25 = $request->input('we25');
  		if($we25 != 'Free'){
  			$staff->classes4()->attach($we25);
  		}
  		$th25 = $request->input('th25');
  		if($th25 != 'Free'){
  			$staff->classes4()->attach($th25);
  		}
  		$fr25 = $request->input('fr25');
  		if($fr25 != 'Free'){
  			$staff->classes4()->attach($fr25);
  		}

  		$mo79 = $request->input('mo79');
  		if($mo79 != 'Free'){
  			$staff->classes4()->attach($mo79);
  		}
  		$tu79 = $request->input('tu79');
  		if($tu79 != 'Free'){
  			$staff->classes4()->attach($tu79);
  		}
  		$we79 = $request->input('we79');
  		if($we79 != 'Free'){
  			$staff->classes4()->attach($we79);
  		}
  		$th79 = $request->input('th79');
  		if($th79 != 'Free'){
  			$staff->classes4()->attach($th79);
  		}
  		$fr79 = $request->input('fr79');
  		if($fr79 != 'Free'){
  			$staff->classes4()->attach($fr79);
  		}
    }elseif ($week == '5') {
      foreach ($staff->classes5 as $key=>$sclass){
        $staff->classes5()->detach($sclass->id);
      }

      $mo912 = $request->input('mo912');
  		if($mo912 != 'Free'){
        $staff->classes5()->attach($mo912);
  		}
  		$tu912 = $request->input('tu912');
  		if($tu912 != 'Free'){
  			$staff->classes5()->attach($tu912);
  		}
  		$we912 = $request->input('we912');
  		if($we912 != 'Free'){
  			$staff->classes5()->attach($we912);
  		}
  		$th912 = $request->input('th912');
  		if($th912 != 'Free'){
  			$staff->classes5()->attach($th912);
  		}
  		$fr912 = $request->input('fr912');
  		if($fr912 != 'Free'){
  			$staff->classes5()->attach($fr912);
  		}

  		$mo25 = $request->input('mo25');
  		if($mo25 != 'Free'){
  			$staff->classes5()->attach($mo25);
  		}
  		$tu25 = $request->input('tu25');
  		if($tu25 != 'Free'){
  			$staff->classes5()->attach($tu25);
  		}
  		$we25 = $request->input('we25');
  		if($we25 != 'Free'){
  			$staff->classes5()->attach($we25);
  		}
  		$th25 = $request->input('th25');
  		if($th25 != 'Free'){
  			$staff->classes5()->attach($th25);
  		}
  		$fr25 = $request->input('fr25');
  		if($fr25 != 'Free'){
  			$staff->classes5()->attach($fr25);
  		}

  		$mo79 = $request->input('mo79');
  		if($mo79 != 'Free'){
  			$staff->classes5()->attach($mo79);
  		}
  		$tu79 = $request->input('tu79');
  		if($tu79 != 'Free'){
  			$staff->classes5()->attach($tu79);
  		}
  		$we79 = $request->input('we79');
  		if($we79 != 'Free'){
  			$staff->classes5()->attach($we79);
  		}
  		$th79 = $request->input('th79');
  		if($th79 != 'Free'){
  			$staff->classes5()->attach($th79);
  		}
  		$fr79 = $request->input('fr79');
  		if($fr79 != 'Free'){
  			$staff->classes5()->attach($fr79);
  		}
    }elseif ($week == '6') {
      foreach ($staff->classes6 as $key=>$sclass){
        $staff->classes6()->detach($sclass->id);
      }

      $mo912 = $request->input('mo912');
  		if($mo912 != 'Free'){
        $staff->classes6()->attach($mo912);
  		}
  		$tu912 = $request->input('tu912');
  		if($tu912 != 'Free'){
  			$staff->classes6()->attach($tu912);
  		}
  		$we912 = $request->input('we912');
  		if($we912 != 'Free'){
  			$staff->classes6()->attach($we912);
  		}
  		$th912 = $request->input('th912');
  		if($th912 != 'Free'){
  			$staff->classes6()->attach($th912);
  		}
  		$fr912 = $request->input('fr912');
  		if($fr912 != 'Free'){
  			$staff->classes6()->attach($fr912);
  		}

  		$mo25 = $request->input('mo25');
  		if($mo25 != 'Free'){
  			$staff->classes6()->attach($mo25);
  		}
  		$tu25 = $request->input('tu25');
  		if($tu25 != 'Free'){
  			$staff->classes6()->attach($tu25);
  		}
  		$we25 = $request->input('we25');
  		if($we25 != 'Free'){
  			$staff->classes6()->attach($we25);
  		}
  		$th25 = $request->input('th25');
  		if($th25 != 'Free'){
  			$staff->classes6()->attach($th25);
  		}
  		$fr25 = $request->input('fr25');
  		if($fr25 != 'Free'){
  			$staff->classes6()->attach($fr25);
  		}

  		$mo79 = $request->input('mo79');
  		if($mo79 != 'Free'){
  			$staff->classes6()->attach($mo79);
  		}
  		$tu79 = $request->input('tu79');
  		if($tu79 != 'Free'){
  			$staff->classes6()->attach($tu79);
  		}
  		$we79 = $request->input('we79');
  		if($we79 != 'Free'){
  			$staff->classes6()->attach($we79);
  		}
  		$th79 = $request->input('th79');
  		if($th79 != 'Free'){
  			$staff->classes6()->attach($th79);
  		}
  		$fr79 = $request->input('fr79');
  		if($fr79 != 'Free'){
  			$staff->classes6()->attach($fr79);
  		}
    }elseif ($week == '7') {
      foreach ($staff->classes7 as $key=>$sclass){
        $staff->classes7()->detach($sclass->id);
      }

      $mo912 = $request->input('mo912');
  		if($mo912 != 'Free'){
        $staff->classes7()->attach($mo912);
  		}
  		$tu912 = $request->input('tu912');
  		if($tu912 != 'Free'){
  			$staff->classes7()->attach($tu912);
  		}
  		$we912 = $request->input('we912');
  		if($we912 != 'Free'){
  			$staff->classes7()->attach($we912);
  		}
  		$th912 = $request->input('th912');
  		if($th912 != 'Free'){
  			$staff->classes7()->attach($th912);
  		}
  		$fr912 = $request->input('fr912');
  		if($fr912 != 'Free'){
  			$staff->classes7()->attach($fr912);
  		}

  		$mo25 = $request->input('mo25');
  		if($mo25 != 'Free'){
  			$staff->classes7()->attach($mo25);
  		}
  		$tu25 = $request->input('tu25');
  		if($tu25 != 'Free'){
  			$staff->classes7()->attach($tu25);
  		}
  		$we25 = $request->input('we25');
  		if($we25 != 'Free'){
  			$staff->classes7()->attach($we25);
  		}
  		$th25 = $request->input('th25');
  		if($th25 != 'Free'){
  			$staff->classes7()->attach($th25);
  		}
  		$fr25 = $request->input('fr25');
  		if($fr25 != 'Free'){
  			$staff->classes7()->attach($fr25);
  		}

  		$mo79 = $request->input('mo79');
  		if($mo79 != 'Free'){
  			$staff->classes7()->attach($mo79);
  		}
  		$tu79 = $request->input('tu79');
  		if($tu79 != 'Free'){
  			$staff->classes7()->attach($tu79);
  		}
  		$we79 = $request->input('we79');
  		if($we79 != 'Free'){
  			$staff->classes7()->attach($we79);
  		}
  		$th79 = $request->input('th79');
  		if($th79 != 'Free'){
  			$staff->classes7()->attach($th79);
  		}
  		$fr79 = $request->input('fr79');
  		if($fr79 != 'Free'){
  			$staff->classes7()->attach($fr79);
  		}
    }
	 return redirect()->to('staff');
	}
}
