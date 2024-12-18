<?php

namespace App\Http\Controllers;

use App\Models\polis;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PoliController extends Controller
{
    public function index()
    {
        $polis = polis::all();
        return view('dashboard.polis.index', compact('polis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required',
            'kode' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $poli = polis::create([
            'nama_poli' => "Layanan $request->nama_poli",
            'kode' => $request->kode,
            'user_id' => $request->user_id,
        ]);
        if ($poli){
            flash('Data berhasil ditambahkan!')->success();
        }else {
            flash('Data Gagal ditambahkan!')->error();
        }
        return redirect()->route('polis.index')->with('success', 'Poli created successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required',
            'kode' => 'required',
            'user_id' => 'required|exists:users,id',
    
        ]);
        $poli = polis::findOrFail($id);
        $poli->update($request->all());
        if ($poli){
            flash('Data berhasil diperbarui!')->success();
        }else {
            flash('Data Gagal diperbarui!')->error();
        }
        return redirect()->route('polis.index')->with('success', 'Poli updated successfully.');
    }

    public function destroy($id)
    {
        $poli = polis::findOrFail($id);
        $poli->delete();
        if ($poli){
            flash('Data berhasil dihapus!')->success();
        }else {
            flash('Data Gagal dihapus!')->error();
        }
        return redirect()->route('polis.index')->with('success', 'Poli deleted successfully.');
    }
}
