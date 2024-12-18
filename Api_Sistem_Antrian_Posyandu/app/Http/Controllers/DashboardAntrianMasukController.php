<?php

namespace App\Http\Controllers;

use App\Models\mengantri;
use App\Models\poli_tsds;
use App\Models\polis;
use Illuminate\Http\Request;

class DashboardAntrianMasukController extends Controller
{
    public function index($slug)
    {
        $antrian = poli_tsds::where('slug', $slug)
        ->orderBy('created_at', 'asc')
        ->first();
        $listAntrian = mengantri::where('id_poli_tsd', $antrian->id)->get();
        return view('dashboard.antrian-masuk.index', [
            'antrian' => $antrian,
            'listAntrian' => $listAntrian
        ]);
    }
}
