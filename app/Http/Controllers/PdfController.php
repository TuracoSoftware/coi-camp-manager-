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

				$sclass = Sclass::find($sclass_id);

        $scouts_count = count($scouts);
        $view =  \View::make('pdf.roster', compact('scouts', 'week', 'sclass', 'scouts_count'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('roster');
    }

		public function roster_print_week($week, $day) {
			$total = array();
			$sclasses = Sclass::where('day', $day)->orderBy('department', 'asc')->orderBy('name', 'asc')->get();
			$scouts_count = NULL;
			$total_num_scouts = array();
			$count = 0;
			$i = 0;
			foreach($sclasses as $key=>$class) {
				$scouts = $this->get_scout_per_class($class->id,$week);
				$total[$count] = $scouts;
				$count++;
				$scouts_count = count($scouts);
				$total_num_scouts[$i] = $scouts_count;
				$i++;
			}

	  	$view = \View::make('pdf.roster_day', compact('total', 'sclasses', 'week', 'total_num_scouts'))->render();
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($view);
			$pdf->setPaper('a4', 'landscape');
			return $pdf->stream('roster_day');
		}

		public function get_scout_per_class($sclass_id, $week) {
			$sclass = Sclass::find($sclass_id);
			$troops = Troop::where('week_attending_camp', $week)->orderBy('troop', 'asc')->get();
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
