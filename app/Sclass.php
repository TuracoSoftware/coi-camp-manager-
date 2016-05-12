<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'sclasses';

    public function scouts() {
      return $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id');
    }

    public function count_scouts($id, $week){

      $sclass = $this->belongsToMany('App\Scout', 'scout_sclass', 'sclass_id', 'scout_id')->where('sclass_id',$id)->get();

      $troops = Troop::where('week_attending_camp', $week)->get();

      $scouts = [];

      foreach($troops as $key => $troop) {
        $scouts_ = $troop->scouts;
        foreach($scouts_ as $key => $scout) {
          if($scout->classExists($sclass_id)){
            $scouts[] = $scout;
          }
        }
      }
      //remove duplicates
      $final_scouts = array_unique($scouts);

      return $week;

      }
}
