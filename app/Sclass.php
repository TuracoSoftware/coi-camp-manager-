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

    	return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id')->distinct('scout_id')->count('scout_id');

    }

    public function count_scouts_week($week){
      $my_scouts = $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id')->distinct('scout_id')->get();
      $count = 0.0;

      foreach($my_scouts as $key => $scout){
        if($scout->troop->week_attending_camp == $week){
          $count++;
        }
      }

      return $count;
    }

}
