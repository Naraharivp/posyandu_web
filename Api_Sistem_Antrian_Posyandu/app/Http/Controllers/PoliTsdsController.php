<?php

namespace App\Http\Controllers;

use App\Models\poli_tsds;
use App\Models\polis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Illuminate\Database\QueryException;

class PoliTsdsController extends Controller
{
    public function index()
    {
        $poliTsds = poli_tsds::all();
        $polis = polis::all();
        return view('dashboard.polis_tsds.index', compact('poliTsds', 'polis'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'nama_poli_tsd' => 'required',
            'kode_poli_tsd' => 'required',
            'syarat' => 'required',
            'kuota' => 'required',
        ]);

        $slug = Str::slug($request->nama_poli_tsd, '-');

        if (poli_tsds::where('slug', $slug)->exists()) {
            flash('Tidak dapat membuat 2 Antrian yang sama!!!.')->error();
            return back()->withErrors(['msg', 'Slug sudah digunakan. Silakan gunakan nama lain.']);
        }

        try {
            poli_tsds::create([
                'nama_poli_tsd' => $request->nama_poli_tsd,
                'kode_poli_tsd' => $request->kode_poli_tsd,
                'deskripsi' => $request->deskripsi,
                'slug' => $slug,
                'syarat' => $request->syarat,
                'kuota' => $request->kuota,
                'user_id' => 1,
            ]);
            flash('Data berhasil ditambahkan!')->success();
            return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dibuka!');
        } catch (QueryException $e) {
            flash('Terjadi kesalahan saat menyimpan data.')->error();
            return back()->withErrors(['msg', 'Terjadi kesalahan saat menyimpan data.']);
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli_tsd' => 'required',
            'kode_poli_tsd' => 'required',
            'deskripsi' => 'required',
            'syarat' => 'required',
            'kuota' => 'required',
            
        ]);
        $poliTsd = poli_tsds::findOrFail($id);
        $up = $poliTsd->update([
            'nama_poli_tsd' => $request->nama_poli_tsd,
            'kode_poli_tsd' => $request->kode_poli_tsd,
            'deskripsi' => $request->deskripsi,
            'syarat' => $request->syarat,
            'kuota' => $request->kuota,
            'update_at' => now()
            
        ]);
        if ($up){
            flash('Data berhasil diperbarui!')->success();
        }
        flash('Data Gagal diperbarui!')->error();
        Flash::success('Data berhasil diubah!');
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $poliTsd = poli_tsds::findOrFail($id);
        $poliTsd->delete();
        if ($poliTsd){
            flash('Data berhasil dihapus!')->success();
        }
        flash('Data Gagal dihapus!')->error();
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dihapus!');
    }
}
