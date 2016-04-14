<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoutmaster extends Model
{
  public function troop() {

    return $this->belongsTo('App\Troop','troop_id');

  }

  public function classes() {

    return $this->belongsToMany('App\ScoutmasterSession', 'scoutmaster_session', 'scoutmaster_id', 'scoutmastersession_id');

  }
}
