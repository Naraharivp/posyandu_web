<?php

namespace App\Http\Controllers;

use App\Models\poli_tsds;
use Illuminate\Http\Request;

class HomeDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        return view('dashboard.home');
    }
}
