<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluhan;
use App\Models\Servis;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $totalKeluhanHariIni = Keluhan::whereDate('created_at', today())->count();
        $jumlahServisHariIni = Servis::whereDate('tanggal_servis', today())->count();
        $totalKeluhan = Keluhan::count();
        $totalServis = Servis::count();

        // Mengambil keluhan dengan servis yang statusnya selesai (status = 1)
        $keluhanServisSelesai = Keluhan::with([
            'customer',
            'servis' => function ($query) {
                $query->where('status', '1');
            },
            'servis.pegawai',
            'servis.items.barang'
        ])->get();

        // Mengambil keluhan dengan servis yang statusnya belum selesai (status = 0)
        $keluhanServisBelumSelesai = Keluhan::with([
            'customer',
            'servis' => function ($query) {
                $query->where('status', '0');
            },
            'servis.pegawai',
            'servis.items.barang'
        ])->get();

        Log::info('Total Keluhan Hari Ini: ' . $totalKeluhanHariIni);
        Log::info('Jumlah Servis Hari Ini: ' . $jumlahServisHariIni);
        Log::info('Total Keluhan: ' . $totalKeluhan);
        Log::info('Total Servis: ' . $totalServis);

        return view('home', compact('totalKeluhanHariIni', 'jumlahServisHariIni', 'totalKeluhan', 'totalServis', 'keluhanServisSelesai', 'keluhanServisBelumSelesai'));
    }

}
