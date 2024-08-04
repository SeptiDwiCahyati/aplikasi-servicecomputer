<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'merek',
        'harga',
        'stok',
        'satuan',
        'supplier_id'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id_supplier');
    }

    // Add the kurangiStok method
    public function kurangiStok($jumlah)
    {
        // Check if there's enough stock
        if ($this->stok >= $jumlah) {
            // Reduce the stock
            $this->stok -= $jumlah;
            $this->save(); // Save the changes to the database

            return true;
        }

        // If not enough stock, return false
        return false;
    }
}
