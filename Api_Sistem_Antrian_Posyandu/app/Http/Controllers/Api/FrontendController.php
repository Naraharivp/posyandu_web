<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\mengantri;
use App\Models\poli_tsds;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function getDataAll()
    {
        $data = mengantri::select([
            'tanggal_ngantri as tanggal_ngantri',
            'kode_antrian as kode_antrian',
            'nama_pelanggan as nama',
        ])->get();
        $count = $data->count();
        return response()->json([
            [
                'status' => 200,
                'message' => 'success',
                'data' => [
                    'jumlah' => $count,
                    'body' => $data,
                ]
            ]
        ]);
    }

    // START ===== Cari data antrian by id Layanan Atau Ploting data antrian
    public function getListLayanan_tersedia()
    {
        $data = poli_tsds::all();
        $count = $data->count();
        return response()->json([
            [
                'status' => 200,
                'message' => 'success',
                'data' => [
                    'jumlah' => $count,
                    'body' => $data,
                ]
            ]
        ]);
    }

    public function getDataPendaftarAntrian(Request $request)
    {
        $id = $request->query('id');
        $antrian = Mengantri::where('id_poli_tsd', $id)
            ->get();

        if ($antrian->isEmpty()) {
            return response()->json(['message' => 'Tidak ada antrian yang ditemukan'], 404);
        }

        return response()->json([
            "message" => "Data Berhasil Diambil!",
            "status" => 200,
            "body" => $antrian
        ]);
    }
    
    // END ====== Cari data antrian by id Layanan Atau Ploting data antrian

    public function riwayat()
    {
        $exists = mengantri::where('user_id', Auth::id())->exists();
        
        if ($exists){
            $data = mengantri::where('user_id', Auth::id())->get();
            return response()->json([
                'message'=> 'Antrian Berhasil diAmbil!',
                'status' => 200,
                'body'=> $data,

            ]);
            
        }else{
            return response()->json([
                'message'=> 'Tidak ada Antrian',
               
            ],201);
        }
    }
}
