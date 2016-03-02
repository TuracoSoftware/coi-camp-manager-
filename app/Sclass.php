<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'sclasses';

    public function scouts() {
      return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id');
    }
}
