<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Keluhan;
use App\Models\Customer;
use App\Models\Computer;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('show_all')) {
            $keluhans = Keluhan::with('customer', 'computer')->whereNull('deleted_at')->get();
        } else {
            $keluhans = Keluhan::with('customer', 'computer')->whereNull('deleted_at')->paginate(10);
        }
        $computers = Computer::all();
        $customers = Customer::all();
        return view('keluhan.index', [
            'keluhans' => $keluhans,
            'customers' => $customers,
            'customer' => $request->customer,
            'computers' => $computers,
        ]);
    }

    public function checkCustomerId(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
        ]);

        $customer = Customer::find($request->customer_id);
        return response()->json([
            'success' => true,
            'customer' => $customer
        ]);
    }

    public function edit($id)
    {
        $keluhan = Keluhan::with('customer')->findOrFail($id);
        $computers = Computer::all();

        return response()->json([
            'success' => true,
            'keluhan' => $keluhan,
            'computers' => $computers
        ]);
    }

    public function destroy($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->delete();
        return redirect()->route('keluhan.index')->with('success', 'Keluhan berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_keluhan' => 'required',
            'ongkos' => 'required|numeric',
            'id_komputer' => 'required|max:10',
            'customer_id' => 'required|exists:customers,customer_id',
            'deskripsi' => 'nullable|string' 
        ]);

        $keluhan = Keluhan::findOrFail($id);

        $keluhan->update($validatedData);

        return redirect()->route('keluhan.index')->with('success', 'Keluhan berhasil diperbarui.');
    }

    public function addKeluhan(Request $request)
    {
        $validatedData = $request->validate([
            'nama_keluhan' => 'required',
            'ongkos' => 'required|numeric',
            'id_komputer' => 'required|max:10',
            'customer_id' => 'required|exists:customers,customer_id',
            'deskripsi' => 'nullable|string' 
        ]);

        Keluhan::create($validatedData);

        Session::flash('success', 'Keluhan berhasil ditambahkan');
        return redirect()->route('keluhan.index');
    }

    public function getKeluhanById(string $id_keluhan)
    {
        $keluhan = Keluhan::find($id_keluhan);

        if (!$keluhan) {
            return response()->json([
                'message' => 'Keluhan tidak ditemukan'
            ], 404);
        }

        return response()->json($keluhan);
    }

    public function updateKeluhan(Request $request, string $id_keluhan)
    {
        $keluhan = Keluhan::find($id_keluhan);

        if (!$keluhan) {
            return response()->json([
                'message' => 'Keluhan tidak ditemukan'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama_keluhan' => 'required',
            'ongkos' => 'required|numeric',
            'id_komputer' => 'required|max:10',
            'customer_id' => 'required|exists:customers,customer_id',
            'deskripsi' => 'nullable|string' 
        ]);

        $keluhan->update($validatedData);

        return response()->json([
            'message' => 'Keluhan berhasil diperbarui'
        ], 200);
    }

    public function deleteKeluhan(string $id_keluhan)
    {
        $keluhan = Keluhan::find($id_keluhan);

        if (!$keluhan) {
            return response()->json([
                'message' => 'Keluhan tidak ditemukan'
            ], 404);
        }

        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus'
        ], 200);
    }
}
