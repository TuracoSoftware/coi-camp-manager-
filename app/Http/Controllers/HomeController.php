<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application's End User Insttuctoins
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == 'admin'){
            return redirect()->to('/administrator');
        }elseif (Auth::user()->type == 'director'){
            return redirect()->to('/director');
        }elseif (Auth::user()->type == 'staff'){
            return redirect()->to('/staff');
        }else {
            return view('home');
        }
    }
}
