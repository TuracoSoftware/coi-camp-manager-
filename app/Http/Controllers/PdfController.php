<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scout;
use App\Troop;
use App\Sclass;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    /*
		Takes a scout's ID and
		Returns a PDF view for a single scout's course schedule
		*/
	public function scout_print($id)
    {

        $scout = Scout::find($id);
        $earnings = $scout->totalfee();
        $view =  \View::make('pdf.scoutschedule', compact('scout', 'earnings'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }

		/*
		* Takes a class ID and that week and returns a roster view for the requested class
		*/
    public function roster_print($sclass_id, $week)
    {


        $sclass = Sclass::find($sclass_id);

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

        $scouts_count = count($final_scouts);

        $view =  \View::make('pdf.roster', compact('final_scouts', 'week', 'sclass', 'scouts_count'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('roster');




    }


}
