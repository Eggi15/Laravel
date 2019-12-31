<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
    	//helper collection (map,sortByDesc)
    	
    	//dd($siswa);
    	return view('dashboards.index');
    }
}
																