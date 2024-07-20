<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Computer;

class Keluhan extends Model
{
    protected $table = 'keluhan';
    use SoftDeletes;
    protected $primaryKey = 'id_keluhan';

    use HasFactory;


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


    public function computer()
    {
        return $this->belongsTo(Computer::class, 'id_komputer');
    }
    public function servis()
    {
        return $this->hasMany(Servis::class, 'keluhan_id', 'id_keluhan');
    }
}