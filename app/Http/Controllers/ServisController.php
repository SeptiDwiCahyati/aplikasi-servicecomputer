<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;
use App\Models\Keluhan;
use App\Models\Pegawai;
use App\Models\Barang;

class ServisController extends Controller
{
    public function index()
    {
        $servis = Servis::all();
        return view('servis.index', compact('servis'));
    }

    public function create()
    {
        $keluhan = Keluhan::all();
        $pegawai = Pegawai::all();
        $barang = Barang::all();
        return view('servis.create', compact('keluhan', 'pegawai', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'tanggal_servis' => 'required|date',
            'deskripsi_servis' => 'required|string',
        ]);

        Servis::create($request->all());

        return redirect()->route('servis.index')
            ->with('success', 'Servis created successfully.');
    }

    public function show($id)
    {
        $servis = Servis::find($id);
        return view('servis.show', compact('servis'));
    }

    public function edit($id)
    {
        $servis = Servis::find($id);
        $keluhan = Keluhan::all();
        $pegawai = Pegawai::all();
        $barang = Barang::all();
        return view('servis.edit', compact('servis', 'keluhan', 'pegawai', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keluhan_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'tanggal_servis' => 'required|date',
            'deskripsi_servis' => 'required|string',
        ]);

        $servis = Servis::find($id);
        $servis->update($request->all());

        return redirect()->route('servis.index')
            ->with('success', 'Servis updated successfully.');
    }

    public function destroy($id)
    {
        $servis = Servis::find($id);
        $servis->delete();

        return redirect()->route('servis.index')
            ->with('success', 'Servis deleted successfully.');
    }
}
