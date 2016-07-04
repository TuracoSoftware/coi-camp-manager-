<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Scoutmaster;
use App\ScoutmasterSession;
use Auth;
use Validator;

class ScoutMasterController extends Controller
{
    // Start the auth class to determine user type
    public function __constuct() {
      $this->middleware('auth');
    }
    // Gather infromation for index page
    public function index() {
      if(Auth::user()->type == 'admin'){
        $scoutmaster = Scoutmaster::all();        // Get all the scoutmasters
        return view('admin.scoutmaster.index')
                    ->with('scoutmasters',$scoutmaster);
      } else {
  			if(Auth::user()->troop)
  		  		$scoutmaster = Scoutmaster::where('troop_id', Auth::user()->troop->id)->get();
  		    else
  		    	$scoutmaster = [];
  			return view('scoutmaster.index')
  		    	        ->with('scoutmasters',$scoutmaster);

  		}
    }

    public function create() {
      return view('scoutmaster.create');
    }

    public function schedule($id) {
      $scoutmaster = Scoutmaster::find($id);
      if($scoutmaster) {
        $troop_id = NULL;
        if(Auth::user()->troop) {
          $troop_id = Auth::user()->troop->id;
        }
      } else {
        return view('login');
      }
      if($scoutmaster->troop_id == $troop_id || Auth::user()->type == 'admin' ){
        $monday = NULL;
        $tuesday = NULL;
        $wednesday = NULL;
        $thurseday = NULL;
        $friday = NULL;
        $scoumastersessions = $scoutmaster->classes;
        if(count($scoumastersessions) > 0)
  			foreach($scoutmastersessions as $sclass) {
  				// If the duration is AM Only or AM & PM set AM to the sclass name
  				if($sclass->day == 'Monday' ){
  					$monday = $sclass->name;
  				}
  				if($sclass->day == 'Tuesday' ){
  					$tuesday = $sclass->name;
  				}
  				if($sclass->day == 'Wednesday'){
  					$wednesday = $sclass->name;
  				}
  				if($sclass->day == 'Thursday') {
  					$thurseday = $sclass->name;
  				}
  				if($sclass->day == 'Friday') {
  					$friday = $sclass->name;
  				}
        }

        $scoutmastersessions_monday = ScoutmasterSession::where('day', 'Monday')->orderBy('name','asc')->get();
        $scoutmastersessions_tuesday = ScoutmasterSession::where('day', 'Tuesday')->orderBy('name','asc')->get();
        $scoutmastersessions_wednesday = ScoutmasterSession::where('day', 'Wednesday')->orderBy('name','asc')->get();
        $scoutmastersessions_thurseday = ScoutmasterSession::where('day', 'Thurseday')->orderBy('name','asc')->get();
        $scoutmastersessions_friday = ScoutmasterSession::where('day', 'Friday')->orderBy('name','asc')->get();

        $context = array(
          'monday' => $monday,
          'tueday' => $tuesday,
          'wednesday' => $wednesday,
          'thurseday' => $thurseday,
          'friday' => $friday,

          'scoutmastersessions_monday' => $scoutmastersessions_monday,
          'scoutmastersessions_tuesday'=> $scoutmastersessions_tuesday,
          'scoutmastersessions_wednesday' => $scoutmastersessions_wednesday,
          'scoutmastersessions_thurseday' => $scoutmastersessions_thurseday,
          'scoutmastersessions_friday' => $scoutmastersessions_friday,
        );

        if(Auth::user()->type == 'admin'){
    			return view('admin.scoutmaster.schedule', $context)
    	                ->with('id', $scoutmaster->id)
    	                ->with('scoutmaster', $scoutmaster);
    		} else {
    		  return view('scoutmaster.schedule', $context)
    		              ->with('id', $scoutmaster->id)
    		              ->with('scoutmaster', $scoutmaster);
    		}
        return redirect()->to('scoutmaster');
  		} else {
        return view('login');
      }
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
  		    $scoutmaster = new Scoutmaster;
  		    $scoutmaster->firstname = $request->input('firstname');
  		    $scoutmaster->lastname = $request->input('lastname');
  		    if(Auth::user()->type != 'admin')
  		    	$scoutmaster->troop_id = Auth::user()->troop->id;
  		    $scoutmaster->save();
  		    return redirect()->to('scoutmaster');
  		}
    }
}
