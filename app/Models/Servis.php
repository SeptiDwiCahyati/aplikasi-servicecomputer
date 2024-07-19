<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluhan_id',
        'pegawai_id',
        'barang_id',
        'tanggal_servis',
        'deskripsi_servis',
    ];
}
