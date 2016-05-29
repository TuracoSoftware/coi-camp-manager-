<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Scout;
use App\Troop;
use App\Sclass;

class PdfController extends Controller
{
  /**
	*	This function is used to create an individual roster for a single scout
	* TODO: Make $fee equal to te scouts total fee due at camp. For instance, Shotgun is $40
	* and Rifle is $30, and a scout is taking both. It should
	*/
	public function scout_print($id) {
    $scout = Scout::find($id);						// Get the scout whos ID was supplied
    // TODO: $fee = $scout->totalfee();		// modify Sclass model to get this to work

    $view =  \View::make('pdf.scoutschedule', compact('scout', 'fee'))->render(); 		// make a view compatible with domPDF
    $pdf = \App::make('dompdf.wrapper');	// create a pdf
    $pdf->loadHTML($view);								// load the HTML into the pdf

   	return $pdf->stream('invoice');				// return the pdf
  }

		/**
		* Utilize this function when you only need to access a single roster. Send it the class ID and the week of the
		* roster you Need.
		* @param sclass_id: ID of the class you are requesting
		* @param week: The week of the roster that you are wanting
		*/
    public function roster_print($sclass_id, $week) {
			$sclass = Sclass::find($sclass_id);													// Create the class object
			$scouts = $this->get_scout_per_class($sclass, $week);		// Getting all the scouts in a class.

      $scouts_count = count($scouts);															// get a count of the scouts returned by get_scout_per_class method
      $view =  \View::make('pdf.roster', compact('scouts', 'week', 'sclass', 'scouts_count'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream('roster');
    }

		/**
		* Use this method to print out rosters for all classes on a single day of a given week.
		* @param $week: Week you need all the rosters of a day from
		* @param $day: The day you need all the rosters from.
		*/
		public function roster_print_week($week, $day) {
			// Get the classes offered on day requested ordered by department & name
			$sclasses = Sclass::where('day', $day)->orderBy('department', 'asc')->orderBy('name', 'asc')->get();

			//Initilizeing variables
			$total = array();										// Scouts per class
			$count = 0;

			// foreach loop is used to cycle through all sclasses that were determined to be offered on a given day
			foreach($sclasses as $key=>$class) {
				$total[$count] = $this->get_scout_per_class($class,$week);  // looping through each class getting the scout from it
				$count++;
			}

			// Makin the view
	  	$view = \View::make('pdf.roster_day', compact('total', 'sclasses', 'week'))->render();
			$pdf = \App::make('dompdf.wrapper');
			$pdf->loadHTML($view);
			$pdf->setPaper('a4', 'landscape');

			return $pdf->stream('roster_day');
		}

		/**
		* Use the method to get the scouts attending
		*/
		public function get_scout_per_class($sclass, $week) {
			$troops = Troop::where('week_attending_camp', $week)->orderBy('troop', 'asc')->get();
			$scouts = [];

	    foreach($troops as $key => $troop) {
    		$scouts_ = $troop->scouts;
	      	foreach($scouts_ as $key => $scout) {
						if($scout->classExists($sclass->id)){
								$scouts[]=$scout;
			      }
					}
			}

			$final_scouts = array_unique($scouts); 		// Remove any unessary duplications
			return $scouts;
		}
}
