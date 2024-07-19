<?php
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

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id_barang');
    }
}
