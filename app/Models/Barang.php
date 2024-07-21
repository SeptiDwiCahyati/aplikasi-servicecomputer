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
    ];

    public function itemServis()
    {
        return $this->hasMany(ItemServis::class, 'barang_id', 'id_barang');
    }

    // Metode untuk mengurangi stok
    public function kurangiStok($jumlah)
    {
        if ($this->stok >= $jumlah) {
            $this->stok -= $jumlah;
            $this->save();
            return true;
        }
        return false;
    }
}
