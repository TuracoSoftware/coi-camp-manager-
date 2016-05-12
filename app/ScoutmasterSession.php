<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoutmasterSession extends Model
{
  protected $table = 'scoutmaster_sessions';

  public function scoutmasters() {

    return $this->belongsToMany('App\Scoutmaster', 'scoutmaster_session_registration', 'scoutmaster_session_id', 'scoutmaster_id');

  }
}
