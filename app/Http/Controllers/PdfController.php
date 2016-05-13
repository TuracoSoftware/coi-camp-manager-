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
    //
	public function scout_print($id)
    {

        $scout = Scout::find($id);
        $earnings = $scout->totalfee();
        $view =  \View::make('pdf.scoutschedule', compact('scout', 'earnings'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }


    public function roster_print($sclass_id, $week)
    {
				$scouts = $this->get_scout_per_class($sclass_id, $week);

        $scouts_count = count($scouts);
        $view =  \View::make('pdf.roster', compact('scouts', 'week', 'sclass', 'scouts_count'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('roster');
    }

		public function roster_print_week($week, $day) {
			$sclasses = Sclass::where('day','Monday')->get();
			$pdf = NULL;
			foreach($sclasses as $key=>$class) {
				$scouts = $this->get_scout_per_class($class->id,$week);
				$scouts_count = count($scouts);
				$sclass = $class;
				$view = \View::make('pdf.roster', compact('scouts', 'week', 'sclass', 'scouts_count'))->render();
				$pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
			}
			return $pdf->stream('roster');

		}

		public function get_scout_per_class($sclass_id, $week) {
			$sclass = Sclass::find($sclass_id);
			$troops = Troop::where('week_attending_camp', $week)->get();
			$scouts = [];

	    foreach($troops as $key => $troop) {
    		$scouts_ = $troop->scouts;
	      	foreach($scouts_ as $key => $scout) {
						if($scout->classExists($sclass_id)){
								$scouts[]=$scout;
			      }
					}
			}
			$final_scouts = array_unique($scouts);
			return $scouts;
		}
}
