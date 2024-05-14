<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lakukan logika yang diperlukan untuk halaman beranda di sini
        return view('home');
    }
}
