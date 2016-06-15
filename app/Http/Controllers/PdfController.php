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
    $fee = $scout->totalfee();	         	// modify Sclass model to get this to work

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
			$total = array();
      $reqs = array();
			$count = 0;      // Scouts per class

			// foreach loop is used to cycle through all sclasses that were determined to be offered on a given day
			foreach($sclasses as $class) {
				$total[$count] = $this->get_scout_per_class($class,$week);  // looping through each class getting the scout from it
        $reqs[$count] = $this->getReqs($class->name);
				$count++;
			}

			// Makin the view
	  	$view = \View::make('pdf.roster_day', compact('total', 'reqs', 'sclasses', 'week'))->render();
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

    public function troop_print($id) {
      $troop = Troop::find($id);
      $scouts = $troop->scouts;

      $view =  \View::make('pdf.all_scouts_troop_schedule', compact('troop', 'scouts'))->render(); 		// make a view compatible with domPDF
      $pdf = \App::make('dompdf.wrapper');	// create a pdf
      $pdf->loadHTML($view);								// load the HTML into the pdf

     	return $pdf->stream('invoice');				// return the pdf
    }

    public function all_scout_schedule($week){
      $troops = Troop::where('week_attending_camp',$week)->get();
      $scouts = array();
      foreach($troops as $key=>$troop) {
        $scouts[] = $troop->scouts;
      }

      $view =  \View::make('pdf.all_scouts_schedule', compact('scouts'))->render(); 		// make a view compatible with domPDF
      $pdf = \App::make('dompdf.wrapper');	// create a pdf
      $pdf->loadHTML($view);								// load the HTML into the pdf

     	return $pdf->stream('invoice');
    }

    public function getReqs($badge){
      $requirement = NULL;

      if ($badge == 'Engineering'){
        $requirement = array(
        "1","2","3","4a","4b","4c","4d","4e","5a","5b","6a","6b","6c","6d","6e","6f","6g","7 ","8 ","9 ",
      );
      } if($badge == 'Game Design (Day 1 of 3)'){
        $requirement = array(
          "1a","1b","2","3","4a","4b","4c","4d","5a","5b","5c","5d","6a","6b","6c",
        );
      } if($badge == 'Theater'){
        $requirement == array(
          "1","2","3a","3b","3c","3d","3e","3f","3g","4a","4b","4c","4e","4f","5","6",
        );
      } if($badge == 'Space Exploration'){
        $requirement == array(
          "1a","1b","1c","1d","2","3a","3b","3c","3d","3e","3f","3g","3h","3i","4a","4b","4c","4d","5a",
          "5b","5c","6a","6b","7a","7b","7c","7d","8",
        );
      } if($badge == 'Radio'){
        $requirement == array(
          "1a","1b","1c","1d","2a","2b","3a","3b","3c","4","5a","5b","5c","5d","6","7","8","9a","9b","9c",
        );
      } if($badge == 'NOVA Award Whoosh!(Day 1 of 2)'){
        $requirement == array(
          "1a","1b","1c","2","3a","3b","3c","4a","4b","5a","5b","6",
        );
      } if($badge == 'NOVA Award Designed to Crunch (Day 1 of 2)'){
        $requirement == array(
          "1a","1b","1c","1d","2","3a","3b","3c","3d","3e","4","5",
        );
      } if($badge == 'Chemistry'){
        $requirement == array(
          "1a","1b","1c","1d","2a","2b","2c","3","4a","4b","4c","5","6a","6b","6c","6d","7a","7b","7c","7d",
        );
      } if($badge == 'Photography & Moviemaking'){
        $requirement == array(
          "P1a","P1b","P2a","P2b","P2c","P2d","P2e","P2f","P2g","P3","P4a","P5b","P5c","P5d","P5e","P5f","P6a","P6b","P6c",
          "P7a","P7b","P7c","P8","M1","M2a","M2b","M2c","M2d","M3","M4",
        );
      }  if ($badge == 'Kayaking'){

      $requirement = array(
        "1a","1b","1c","2","3a","3b","4a","4b","4c","4d","5a","5b","5c","5d","5e","5f","6a","6b","6c","6d","6e","7a","7b","7c","7d","7e","7f",
      );
	   }   if ($badge == 'Swimming'){

      $requirement = array(
        "1a","1b","2","3","4a","4b","5a","5b","5c","5d","6a","6b","6c","7","8",
      );
    }   if ($badge == 'Lifesaving'){

      $requirement = array(
        "1a","2","3a","3b","3c","3d","3e","4","5","6","7","8a","8b","9","10","11a","11b","12","13a","13b","13c","14a","14b","15a","15b","16a","16b","16c","17",
      );
    }   if ($badge == 'Canoeing'){

      $requirement = array(
        "1a","1b","1c","2","3a","3b","3c","4a","4b","5a","5b","5c","5d","6","7a","7b","7c","8a","8b","8c","8d","9a","9b","9c","9d","10a","10b","10c","10d","10e","10f","10g","10h","11a","11b","11c","11d","12a","12b","12c","12d","13a","13b","13c","13d","13e","13f","13g",
      );
    }   if ($badge == 'Rowing'){

      $requirement = array(
        "1a","1b","1c","2","3","4a","4b","5a","5b","6","7","8a","8b","8c","9a","9b","9c","9d","9e","9f","9g",
      );
    }   if ($badge == 'Whitewater'){

      $requirement = array(
        "1a","1b","1c","2a","2b","3a","3b","4a","4b","4c","5a","5b","5c","6","7a","7b","8","9a","9b","10a","10b","10c","10d","10e","11","12",
      );
    }   if ($badge == 'Pioneering'){

      $requirement = array(
        "1a","1b","2a","2b","2c","3","4","5","6","7","8","9","10",
      );
    }   if ($badge == 'Orienteering'){

      $requirement = array(
        "1","2","3a","3b","4a","4b","4c","4d","4e","4f","5","6a","6b","6c","7a","7b","8a","8b","9","10",
      );
    }   if ($badge == 'Geocaching'){

      $requirement = array(
        "1a","1b","1c","2a","2b","2c","3","4","5a","5b","5c","5d","6","7","8a","8b","8c","8d","9",
      );
    }   if ($badge == 'Wilderness Survival'){

      $requirement = array(
        "1a","1b","2","3","4a","4b","4c","4d","4e","5","6","7a","7b","7c","8","9","10","11","12",
      );
    }   if ($badge == 'Camping'){

      $requirement = array(
        "1a","1b","2","3","4a","4b","5a","5b","5c","5d","5e","5f","6a","6b","6c","6d","6e","7a","7b","8a","8b","8c","8d","9a","9b","9c","10",
      );
    }   if ($badge == 'Cooking'){

      $requirement = array(
        "1a","1b","1c","1d","1e","2a","2b","2c","2d","2e","3a","3b","3c","4a","4b","4c","4d","4e","5a","5b","5c","5d","5e","5f","5g","5h","6a","6b","6c","6d","6e","6f","7",
      );
    }   if ($badge == 'Rifle Shooting (Recommended for older scouts)'){

      $requirement = array(
        "1a","1b","1c","1d","1e","1f","1g","1h","1i","2a","2b","2c",
      );
    }   if ($badge == 'Shotgun Shooting (Recommended for older scouts)'){

      $requirement = array(
        "1a","1b","1c","1d","1e","1f","1g","1h","1i","2a","2b",
      );
    }   if ($badge == 'Archery'){

      $requirement = array(
        "1a","1b","1c","2a","2b","2c","2d","2e","3a","3b","3c","4a","4b","4c","4d","4e","4f","5a","5b",
      );
    }   if ($badge == 'First Aid'){

      $requirement = array(
        "1","2a","2b","2c","2d","3a","3b","3c","3d","3e","3f","4a","4b","5a","5b","5c","5d","5e","5f","5g","5h","5i","5j","6a","6b","6c","7",
      );
    }   if ($badge == 'Search & Rescue'){

      $requirement = array(
        "1a","1b","2a","2b","2c","3a","3b","3c","4","5","6a","6b","6c","7a","7b","7c","7d","8a","8b","8c","8d","9a","9b","10",
      );
    }   if ($badge == 'Medicine (Day 1 of 2)'){

      $requirement = array(
        "1","2","3","4a","4b","5a","5b","6a","6b","7a","7b","7c","8a","8b","9","10",
      );
    }   if ($badge == 'Medicine (Day 2 of 2)'){

      $requirement = array(
        "1","2","3","4a","4b","5a","5b","6a","6b","7a","7b","7c","8a","8b","9","10",
      );
    }   if ($badge == 'Emergency Preparedness'){

      $requirement = array(
        "1","2a","2b","2c","3a","3b","3c","3d","4","5","6a","6b","6c","7a","7b","8a","8b","9a","9b","9c",
      );
    }   if ($badge == 'Personal Fitness'){

      $requirement = array(
        "1a","1b","2a","2b","2c","2d","2e","2f","3a","3b","3c","3d","3e","3f","3g","3h","3i","3j","3k","4a","4b","4c","4d","5a","5b","5c","5d","6","7","8",
      );
    }   if ($badge == 'Environmental Science'){

      $requirement = array(
        "1","2","3a","3b","3c","3d","3e","3f","3g","4a","4b","5","6",
      );
    }   if ($badge == 'Weather'){

      $requirement = array(
        "1","2","3","4","5","6","7","8","9a","9b","10a","10b","11",
      );
    }   if ($badge == 'Fishing & Fly Fishing'){

      $requirement = array(
        "1a","1b","1c","1d","2","3","4","5","6a","6b","7","8","9",
      );
    }   if ($badge == 'Fishing & Fly Fishing'){

      $requirement = array(
        "1a","1b","1c","2","3a","3b","3c","3d","3e","4","5","6","7a","7b","8","9","10",
      );
    }   if ($badge == 'Astronomy'){
      $requirement = array(
        "1a","1b","1c","2","3a","3b","3c","3d","4a","4b","4c","4d","5a","5b","5c","5d","6a","6b","6c","6d","7a","7b","7c","8a","8b","8c","8d","8e","9",
      );
    }   if ($badge == 'Oceanography'){

      $requirement = array(
        "1","2","3","4a","4b","4c","5","6","7a","7b","7c","7d","7e","7f","8a","8b","8c","9",
      );
    }   if ($badge == 'Geology'){

      $requirement = array(
        "1","2","3","4a","4b","5a","5b","5c","5d",
      );
    }   if ($badge == 'Soil & Water'){

      $requirement = array(
        "1a","1b","1c","2a","2b","2c","2d","3a","3b","3c","4a","4b","4c","4d","5a","5b","5c","5d","5e","6a","6b","6c","6d","7a","7b","7c","7d","7e","7f",
      );
    }   if ($badge == 'Insect Study'){

      $requirement = array(
        "1a","1b","2","3","4","5a","5b","6a","6b","7","8","9","10a","10b","11","12","13",
      );
    }   if ($badge == 'Mammal Study'){

      $requirement = array(
        "1","2","3a","3b","3c","4a","4b","4c","4d","4e","4f","4g","5",
      );
    }   if ($badge == 'Bird Study'){

      $requirement = array(
        "1","2","3a","3b","3c","4a","4b","4c","4d","4e","4f","4g","5a","5b","5c","5d","6","7a","7b","8a","8b","8c",
      );
    }   if ($badge == 'Reptile & Amphibian Study'){

      $requirement = array(
        "1","2","3a","3b","3c","3d","3e","4","5","6","7","8a","8b","9a","9b","9c","10",
      );
    }   if ($badge == 'Nature'){

      $requirement = array(
        "1","2","3","4a","4b","4c","4d","4e","4f","4g","4h",
      );
    }   if ($badge == 'Forestry'){

      $requirement = array(
        "1a","1b","1c","2a","2b","2c","3a","3b","4a","4b","4c","4d","4e","5a","5b","5c","6a","6b","6c","7",
      );
    }   if ($badge == 'Fish and Wildlife Management'){

      $requirement = array(
        "1","2","3","4","5a","5b","5c","5d","6a","6b","6c","7a","7b","7c","7d","8",
      );
    }   if ($badge == 'Energy'){

      $requirement = array(
        "1a","1b","2a","2b","3a","3b","3c","3d","4a","4b","5a","5b","6a","6b","6c","6d","6e","7","8",
      );
    }   if ($badge == 'Cit in the Nation & American Heritage'){

      $requirement = array(
        "1","2a","2b","2c","2d","3","4a","4b","4c","4d","4e","5","6","7","8",
      );
    }   if ($badge == 'Cit in the Nation & American Heritage'){

      $requirement = array(
        "1","2a","2b","2c","2d","3a","3b","3c","4a","4b","4c","4d","4e","5a","5b","5c","6",
      );
    }   if ($badge == 'Personal Management'){

      $requirement = array(
        "1a","1b","1c","2a","2b","3a","3b","3c","3d","3e","3f","3g","3h","4a","4b","4c","5a","5b","5c","6a","6b","6c","6d","6e","7a","7b","7c","7d","7e","8a","8b","8c","8d","9a","9b","9c","9d","9e","10a","10b",
      );
    }   if ($badge == 'Citizenship in the World'){

      $requirement = array(
        "1","2","3a","3b","4a","4b","4c","5a","5b","5c","6a","6b","6c","7a","7b","7c","7d","7e",
      );
    }  if ($badge == 'Communications & Public Speaking'){

      $requirement = array(
        "1a","1b","1c","1d","2a","2b","3","4","5","6","7a","7b","7c","8","9",
      );
    }   if ($badge == 'Law'){

      $requirement = array(
        "1","2a","2b","2c","3","4","5","6a","6b","7","8","9","10","11a","11b","11c","11d","11e","11f","11g","11h",
      );
    }   if ($badge == 'Chess (Day 1 of 3)'){

      $requirement = array(
        "1","2a","2b","3a","3b","3c","4a","4b","4c","4d","4e","4f","5a","5b","5c","5d","6a","6b","6c",
      );
    }   if ($badge == 'Entrepreneurship'){

      $requirement = array(
        "1","2","3","4","5a","5b","5c","5d","5e","6",
      );
    }   if ($badge == 'Mining in Society'){

      $requirement = array(
        "1a","1b","1c","2","3a","3b","3c","4","5a","5b","5c","5d","5e","5f","6a","6b","6c","7a","7b","7c","7d","8a","8b","8c",
      );
    }   if ($badge == 'American Cultures'){

      $requirement = array(
        "1a","1b","1c","1d","1e","2","3","4","5",
      );
    }   if ($badge == 'Traffic Safety'){

      $requirement = array(
        "1a","1b","1c","1d","2a","2b","3a","3b","3c","3d","4a","4b","4c","4d","5a","5b","5c","5d",
      );
    }   if ($badge == 'Leatherwork'){

      $requirement = array(
        "1a","1b","2a","2b","2c","2d","3a","3b","3c","3d","3e","3f","3g","3h","4","5a","5b","5c","5d",
      );
    }   if ($badge == 'Art'){

      $requirement = array(
        "1a","1b","1c","2","3","4a","4b","4c","4d","4e","4f","4g","4h","4i","5a","5b","5c","6","7",
      );
    }   if ($badge == 'Sculpture'){

      $requirement = array(
        "1","2a","2b","2c","3",
      );
    }   if ($badge == 'Woodcarving'){

      $requirement = array(
        "1a","1b","2a","2b","3a","3b","4a","4b","4c","4d","5","6","7",
      );
    }   if ($badge == 'Basketry'){

      $requirement = array(
        "1a","1b","2a","2b","3a","3b","3c",
      );
    }   if ($badge == 'Fingerprinting'){

      $requirement = array(
        "1","2","3a","3b","3c","4a","4b","5",
      );
    }   if ($badge == 'Welding'){

      $requirement = array(
        "1a","1b","2a","2b","2c","3","4","5a","5b","6a","6b","6c","6d","6e","6f","7a","7b",
      );
    }   if ($badge == 'Metalworking'){

      $requirement = array(
        "1","2a","2b","2c","2d","3a","3b","3c","4","5a","5b","5c","5d",
      );
    }

      return $requirement;

    }
}
