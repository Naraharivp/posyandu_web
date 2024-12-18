<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mengantri;
use App\Models\poli_tsds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmbilAntrianController extends Controller
{
    // Proses Store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_ngantri' => 'required|date',
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'id_poli_tsd' => 'required|exists:poli_tsds,id',
        ]);

        $antrian = poli_tsds::findOrFail($validated['id_poli_tsd']);
        $service_code = $antrian->kode_poli_tsd;

        $user_id = $request->user()->id;
        $existing_antrian = Mengantri::where('user_id', $user_id)
            ->where('tanggal_ngantri', $validated['tanggal_ngantri'])
            ->where('id_poli_tsd', $validated['id_poli_tsd'])
            ->first();

        if ($existing_antrian) {
            return response()->json(['error' => "Anda sudah mengambil antrian $antrian->nama_poli_tsd untuk hari ini. Silahkan Ambil di Hari Lain!"], 409);
        }

        $last_record = Mengantri::where('tanggal_ngantri', $validated['tanggal_ngantri'])
            ->where('kode_antrian', 'like', $service_code.'%')
            ->orderBy('created_at', 'desc')
            ->first();

        $next_kode = $last_record ? str_pad(intval(substr($last_record->kode_antrian, -3)) + 1, 3, '0', STR_PAD_LEFT) : '001';

        $kode_antrian = $service_code . '-' . $next_kode;
        $existing_record = Mengantri::where('kode_antrian', $kode_antrian)
            ->where('tanggal_ngantri', $validated['tanggal_ngantri'])
            ->first();

        if ($existing_record) {
            return response()->json(['error' => 'Maaf, gagal mengambil antrian. Silahkan ambil di hari lain'], 409);
        }

        $antrian_count = Mengantri::where('id_poli_tsd', $validated['id_poli_tsd'])
            ->where('tanggal_ngantri', $validated['tanggal_ngantri'])
            ->count();

        $batas_antrian = $antrian->kuota;

        if ($antrian_count >= $batas_antrian) {
            return response()->json(['error' => 'Maaf, Antrian Sudah Penuh. Silahkan Coba Di Hari Lain'], 409);
        }

        $validated['kode_antrian'] = $kode_antrian;
        $validated['user_id'] = $request->user()->id;

        $data = Mengantri::create($validated);
        if ($data) {
            return response()->json(['success' => 'Berhasil Mengambil Antrian'], 201);
        }

        return response()->json(['error' => 'Gagal Mengambil Data!'], 500);
    }
    public function detail()
    {
        return response()->json([
            'message' => 'Data Berhasil Diambil!',
            'detailAntrian' => Mengantri::where('user_id', Auth::id())->get()
        ]);

    }

}
