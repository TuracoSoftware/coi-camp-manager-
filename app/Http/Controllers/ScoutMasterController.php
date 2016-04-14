<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class ScoutMasterController extends Controller
{
    public function __constuct(){
      $this->middleware('auth');
    }

    public function index() {
      if(Auth::user()->type == 'admin'){
        return view('admin.scoutmaster.index');
      } else {
        return view('scoutmaster.index');
      }
    }
}
