<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'sclasses';

    public function scouts() {
      return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id');
    }

    public function badge() {
      return $this->hasMany('App\Badge', 'sclass_id');
    }

    public function count_scouts(){

    	return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id')
        ->distinct('scout_id')
        ->distinct('sclass_id')
        ->count('scout_id');
    }


}
