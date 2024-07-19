<?php

// ItemServis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemServis extends Model
{
    use HasFactory;

    protected $fillable = [
        'servis_id',
        'barang_id',
        'jumlah',
    ];
}
