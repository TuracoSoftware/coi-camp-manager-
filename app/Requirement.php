<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    public function meritbadge(){
      $this->belongsTo('App\MeritBadge','meritbadge_id');
      
    }
}
