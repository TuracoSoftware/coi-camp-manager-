<?php

namespace App;

use App\Sclass;

use Illuminate\Database\Eloquent\Model;

class Troop extends Model
{
  public function user() {

    return $this->belongsTo('App\User', 'user_id');

  }

  public function scouts() {

    return $this->hasMany('App\Scout', 'troop_id', 'week');

  }

  /*public function scoutsBySclassId($id) {

  	$myScouts = $this->hasMany('App\Scout');

  	$current_sclass = Sclass::find($id);

  	$scouts_final = NULL;

  	foreach ($myScouts as $key => $value) {

  		$current_sclasses = $value->classes();

  		if(!in_array($current_sclass, $current_sclasses)){
  			unset($myScouts[$key]);
  		}

  	}
  	return $myScouts;

    //return $this->hasMany('App\Scout')->where();

  }*/

}
