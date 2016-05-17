<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    public function user() {
      return $this->belongsTo('user_id');
    }

}
