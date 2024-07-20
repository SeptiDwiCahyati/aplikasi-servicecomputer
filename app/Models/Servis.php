<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $primaryKey = 'servis_id';
    protected $table = 'servis';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'keluhan_id',
        'pegawai_id',
        'tanggal_servis',
        'deskripsi_servis'
    ];

    public function items()
    {
        return $this->hasMany(ItemServis::class, 'servis_id', 'servis_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_pegawai');
    }
}
