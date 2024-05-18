<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;

class ComputerController extends Controller
{
    public function index()
    {
        $computers = Computer::whereNull('deleted_at')->get(); 
        return view('computer.index', compact('computers')); // Tampilkan view index dengan data komputer
    }

    public function addComputer(Request $request)
    {
        $validatedData = $request->validate([
            'merek' => 'required|in:asus,acer,dell,lain',
            'kelengkapan' => 'required',
        ]);

        $lastActiveComputer = Computer::whereNull('deleted_at')->latest('id_komputer')->first();
        $lastActiveId = $lastActiveComputer ? intval(substr($lastActiveComputer->id_komputer, 2)) : 0;
        $lastDeletedComputer = Computer::onlyTrashed()->latest('id_komputer')->first();
        $lastDeletedId = $lastDeletedComputer ? intval(substr($lastDeletedComputer->id_komputer, 2)) : 0;
        $newId = 'PC' . str_pad(max($lastActiveId, $lastDeletedId) + 1, 3, '0', STR_PAD_LEFT);

        $computer = new Computer();
        $computer->id_komputer = $newId;
        $computer->merek = $validatedData['merek'];
        $computer->kelengkapan = $validatedData['kelengkapan'];
        $computer->save();

        return redirect()->route('computers.index')->with('success', 'Komputer berhasil ditambahkan');
    }
    public function getComputerById(string $id_komputer)
    {
        $computer = Computer::find($id_komputer);

        if (!$computer) {
            return response()->json([
                'message' => 'Komputer tidak ditemukan'
            ], 404);
        }

        return response()->json($computer);
    }
    public function editComputer(string $id_komputer)
    {
        $computer = Computer::find($id_komputer);

        if (!$computer) {
            return redirect()->route('computers.index')->with('error', 'Komputer tidak ditemukan');
        }

        return view('computer.edit', compact('computer'));
    }

    public function updateComputer(Request $request, string $id_komputer)
    {
        $computer = Computer::find($id_komputer);

        if (!$computer) {
            return redirect()->route('computers.index')->with('error', 'Komputer tidak ditemukan');
        }

        $validatedData = $request->validate([
            'merek' => 'required|in:asus,acer,dell,lain',
            'kelengkapan' => 'required',
        ]);

        $computer->merek = $validatedData['merek'];
        $computer->kelengkapan = $validatedData['kelengkapan'];
        $computer->save();

        return redirect()->route('computers.index')->with('success', 'Komputer berhasil diperbarui');
    }


    public function deleteComputer(string $id_komputer)
    {
        $computer = Computer::find($id_komputer);

        if (!$computer) {
            return redirect()->route('computers.index')->with('error', 'Komputer tidak ditemukan');
        }

        $computer->delete();

        return redirect()->route('computers.index')->with('success', 'Komputer berhasil dihapus');
    }
}