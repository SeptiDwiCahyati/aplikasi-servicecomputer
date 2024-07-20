<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $merek = $request->input('merek');
        $query = Barang::query();
        if ($merek) {
            $query->where('merek', $merek);
        }
        $barang = $query->get();
        return view('barang.index', [
            'barang' => $barang,
            'selectedMerek' => $merek
        ]);
    }


    public function create()
    {
        $merekList = ['Toshiba', 'Asus', 'Samsung']; // Example list, modify as needed
        return view('barang.create', ['merekList' => $merekList]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:150',
            'merek' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:10',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang created successfully.');
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $merekList = ['Toshiba', 'Asus', 'Samsung']; // Modify this list as needed
        return view('barang.edit', [
            'barang' => $barang,
            'merekList' => $merekList
        ]);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:150',
            'merek' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:10',
        ]);

        $barang = Barang::find($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang updated successfully.');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang deleted successfully.');
    }
}
