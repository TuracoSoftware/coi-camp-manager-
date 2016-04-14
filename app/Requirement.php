<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    public function badge(){
      return $this->belongsToMany('App\Badge', 'badge_id');
    }
}
