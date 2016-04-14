<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

  public function requirement() {
    return $this->hasMany('App\Requirement', 'badge_id');
  }

  public function sclass() {
    return $this->belongsTo('App\Sclass', 'sclass_id');
  }
}
