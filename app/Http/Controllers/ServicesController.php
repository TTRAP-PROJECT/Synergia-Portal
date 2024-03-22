<?php

namespace App\Http\Controllers;

use App\Models\SERVICE;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function services()
    {
        $services = SERVICE::all();
        return view('services', array('services' => $services));
    }
}
