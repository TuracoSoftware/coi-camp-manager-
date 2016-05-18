<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\MeritBadge;

class MeritBadgeController extends Controller
{
    public function __construct(){
      $this->middleware('auth');

    }
    public function index(){
      if(Auth::user()->type == 'admin'){
        $meritbadge = MeritBadge::all();

        return view('admin.meritbadge.index')
          ->with('meritbadges',$meritbadge);
        }
      }
        public function create(){
          if(Auth::user()->type == 'admin'){

            return view('admin.meritbadge.create');

          }
          else{
            return view('login');
          }
        }
        public function store(Request $request){

        }
}
