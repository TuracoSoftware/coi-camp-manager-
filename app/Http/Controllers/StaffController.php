<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class StaffController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
  }

  public function dispayRoster($week) {
    
  }

  public function get_scout_id_per_class($sclass_id, $week) {
    $sclass = Sclass::find($sclass_id);
    $troops = Troop::where('week_attending_camp', $week)->orderBy('troop', 'asc')->get();
    $scouts = [];

    foreach($troops as $key => $troop) {
      $scouts_ = $troop->scouts;
        foreach($scouts_ as $key => $scout) {
          if($scout->classExists($sclass_id)){
              $scouts[]=$scout;
          }
        }
    }
    $final_scouts = array_unique($scouts);
    return $scouts;
  }

}
