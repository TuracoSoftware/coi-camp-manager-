<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function classes1() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_1', 'staff_id', 'sclass_id');
    }
    public function classes2() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_2', 'staff_id', 'sclass_id');
    }
    public function classes3() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_3', 'staff_id', 'sclass_id');
    }
    public function classes4() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_4', 'staff_id', 'sclass_id');
    }
    public function classes5() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_5', 'staff_id', 'sclass_id');
    }
    public function classes6() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_6', 'staff_id', 'sclass_id');
    }
    public function classes7() {
      return $this->belongsToMany('App\Sclass', 'staff_sclass_7', 'staff_id', 'sclass_id');
    }
}
