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
}
