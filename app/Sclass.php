<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'sclasses';

    public function scouts() {
      return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id');
    }

    public function staff1() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_1', 'staff_id', 'sclass_id');
    }
    public function staff2() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_2', 'staff_id', 'sclass_id');
    }
    public function staff3() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_3', 'staff_id', 'sclass_id');
    }
    public function staff4() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_4', 'staff_id', 'sclass_id');
    }
    public function staff5() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_5', 'staff_id', 'sclass_id');
    }
    public function staff6() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_6', 'staff_id', 'sclass_id');
    }
    public function staff7() {
      return $this->belongsToMany('App\Staff', 'staff_sclass_7', 'staff_id', 'sclass_id');
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
