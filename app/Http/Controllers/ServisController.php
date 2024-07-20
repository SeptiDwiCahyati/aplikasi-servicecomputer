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
        $servis = Servis::with('items.barang')->get();
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
                ItemServis::create([
                    'servis_id' => $servis->servis_id,
                    'barang_id' => $barangId,
                    'jumlah' => $request->jumlah[$key],
                ]);
            }
        } else {
            return redirect()->back()->withErrors('Failed to create Servis.');
        }
        return redirect()->route('servis.index')->with('success', 'Servis berhasil ditambahkan');
    }


    public function show($id)
    {
        $servis = Servis::with(['pegawai', 'items.barang'])->findOrFail($id);
        return view('servis.show', compact('servis'));
    }

    public function destroy($id)
    {
        $servis = Servis::findOrFail($id);
        $servis->items()->delete();
        $servis->delete();
        return redirect()->route('servis.index')->with('success', 'Servis berhasil dihapus');
    }

}
