<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement_started extends Model
{
  protected $table = 'requirments_started';

  public function meritbadge() {
    $this->belongsTo('App\MeritBadgeStarted', 'meritB_id');
  }
}
