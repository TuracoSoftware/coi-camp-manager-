<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }


    /*public function make_User(Request $request) {
      $user = new User;
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $pass = $request->input('password');
      $user->password = bcrypt($pass);
      $user->type = "staff";
      $user->save();
      $this->user_id = $user->id;
    }*/
}
