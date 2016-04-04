<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'sclasses';

    public function scouts() {
      return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id');
    }

    public function count_scouts(){

    	return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id')
        ->distinct('scout_id')
        ->distinct('sclass_id')
        ->count('scout_id');

    }
    /*
    * Method to count all scouts via the week requested
    */
    public function count_scouts_by_week($id){

    	$my_scouts = $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id')
        ->distinct('scout_id')
        ->distinct('sclass_id')
        ->get();

      $sum = 0.0;

        if(!empty($my_scouts)){                // If class is not not emtpy
          foreach($my_scouts as $scout){
            if($scout->troop->week == $id){    // If the class's scout getting counted is in the requested week (found by going through Troop)
             $sum++;
            }
          }
        }
        return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id', 'App\Troop', 'troop_week')
          ->distinct('scout_id')
          ->distinct('sclass_id')
          ->where('troop_week', $id)
          ->count('scout_id');
    }

}
