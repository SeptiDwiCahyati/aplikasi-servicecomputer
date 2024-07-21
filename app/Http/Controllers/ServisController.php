<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;
use App\Models\Keluhan;
use App\Models\Pegawai;
use App\Models\Barang;
use App\Models\ItemServis;

class ServisController extends Controller
{
    public function index()
    {
        $servis = Servis::with('items.barang')->where('status', false)->get();
        $keluhan = Keluhan::all();
        $pegawai = Pegawai::all();
        $barang = Barang::all();
        return view('servis.index', compact('servis', 'keluhan', 'pegawai', 'barang'));
    }

    public function markAsComplete($id)
    {
        $servis = Servis::findOrFail($id);
        $servis->status = true;
        $servis->save();

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $servis = Servis::with('items')->findOrFail($id);
        $keluhan = Keluhan::all();
        $pegawai = Pegawai::all();
        $barang = Barang::all();
        return view('servis.edit', compact('servis', 'keluhan', 'pegawai', 'barang'));
    }

    public function create()
    {
        $keluhan = Keluhan::with('customer')->get();
        $pegawai = Pegawai::all();
        $barang = Barang::all();
        return view('servis.create', compact('keluhan', 'pegawai', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keluhan_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'tanggal_servis' => 'required|date',
            'deskripsi_servis' => 'required|string',
            'barang_id' => 'required|array',
            'barang_id.*' => 'required|integer',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $servis = Servis::findOrFail($id);
        $servis->update($request->only([
            'keluhan_id',
            'pegawai_id',
            'tanggal_servis',
            'deskripsi_servis'
        ]));

        $servis->items()->delete();

        foreach ($request->barang_id as $key => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $jumlah = $request->jumlah[$key];

            if ($barang->kurangiStok($jumlah)) {
                ItemServis::create([
                    'servis_id' => $servis->servis_id,
                    'barang_id' => $barangId,
                    'jumlah' => $jumlah,
                ]);
            } else {
                return redirect()->back()->withErrors("Stok barang {$barang->nama_barang} tidak cukup.");
            }
        }

        return redirect()->route('servis.index')->with('success', 'Servis berhasil diupdate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'tanggal_servis' => 'required|date',
            'deskripsi_servis' => 'required|string',
            'barang_id' => 'required|array',
            'barang_id.*' => 'required|integer',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $servis = Servis::create($request->only([
            'keluhan_id',
            'pegawai_id',
            'tanggal_servis',
            'deskripsi_servis'
        ]));

        if ($servis->servis_id) {
            foreach ($request->barang_id as $key => $barangId) {
                $barang = Barang::findOrFail($barangId);
                $jumlah = $request->jumlah[$key];

                if ($barang->kurangiStok($jumlah)) {
                    ItemServis::create([
                        'servis_id' => $servis->servis_id,
                        'barang_id' => $barangId,
                        'jumlah' => $jumlah,
                    ]);
                } else {
                    return redirect()->back()->withErrors("Stok barang {$barang->nama_barang} tidak cukup.");
                }
            }
        } else {
            return redirect()->back()->withErrors('Failed to create Servis.');
        }

        return redirect()->route('servis.index')->with('success', 'Servis berhasil ditambahkan');
    }

    public function show($id)
    {
        $servis = Servis::with('keluhan.customer', 'pegawai', 'items.barang')->findOrFail($id);
        return view('servis.detail_servis', compact('servis'));
    }

    public function destroy($id)
    {
        $servis = Servis::findOrFail($id);
        $servis->items()->delete();
        $servis->delete();
        return redirect()->route('servis.index')->with('success', 'Servis berhasil dihapus');
    }
}
