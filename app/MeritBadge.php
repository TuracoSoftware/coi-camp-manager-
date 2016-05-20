<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeritBadge extends Model
{
  protected $table = 'merit_badge';
    public function requirement(){
      $this->hasMany('App\Requirement');
    }
}
