<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeritBadgeStarted extends Model
{
  protected $table = 'merit_badge_started';

  public function meritbadge() {
    return $this->belongsTo('App\MeritBadge', 'meritbadge_id');
  }

  public function scout() {
    return $this->belongsTo('App\Scout', 'scout_id');
  }
}
