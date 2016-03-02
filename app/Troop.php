<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Troop extends Model
{
  public function user() {

    return $this->belongsTo('App\User', 'user_id');

  }

  public function scouts() {

    return $this->hasMany('App\Scout');

  }
}
