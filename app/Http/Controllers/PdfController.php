<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scout;
use App\Sclass;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    //
	public function invoice($id) 
    {

        $scout = Scout::find($id);
        $earnings = $scout->totalfee();
        $view =  \View::make('pdf.invoice', compact('scout', 'earnings'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
 

}
