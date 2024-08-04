<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Supplier;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $merek = $request->input('merek');
        $query = Barang::with('supplier');

        if ($merek) {
            $query->where('merek', $merek);
        }

        $barang = $query->paginate(10);
        return view('barang.index', [
            'barang' => $barang,
            'selectedMerek' => $merek
        ]);
    }


    public function create()
    {
        $merekList = ['Toshiba', 'Asus', 'Samsung', 'Lainnya'];
        $suppliers = Supplier::all();
        return view('barang.create', ['merekList' => $merekList, 'suppliers' => $suppliers]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:150',
            'merek' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id_supplier'
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang created successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:150',
            'merek' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id_supplier'
        ]);

        $barang = Barang::find($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang updated successfully.');
    }

    public function show($id)
    {
        $barang = Barang::with('supplier')->find($id);
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $merekList = ['Toshiba', 'Asus', 'Samsung', 'Lainnya'];
        $suppliers = Supplier::all();
        return view('barang.edit', [
            'barang' => $barang,
            'merekList' => $merekList,
            'suppliers' => $suppliers
        ]);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang deleted successfully.');
    }
}
