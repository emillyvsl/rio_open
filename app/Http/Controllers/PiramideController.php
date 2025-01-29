<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PiramideController extends Controller
{
    public function index()
    {

        return view(view: 'time-piramide');

    }

   
}
