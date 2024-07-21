<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'no_hp'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'supplier_id', 'id_supplier');
    }
}
