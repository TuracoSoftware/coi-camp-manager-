<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScoutMasterSessionController extends Controller
{
  public function __constuct(){
    $this->middleware('auth');
  }

  public function index(){
    
  }
}
