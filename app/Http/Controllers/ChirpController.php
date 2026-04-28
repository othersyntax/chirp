<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class ChirpController extends Controller
{
    public function index(){
        return view('chirps');
        // return view('chirps',[]);
    }

}
