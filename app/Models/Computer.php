<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keluhan;

class Computer extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_komputer';
    public $incrementing = false;
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_komputer', 'merek', 'kelengkapan'];

    public static $rules = [
        'id_komputer' => 'required|unique:computers|max:10',
        'merek' => 'required|in:asus,acer,dell,lain',
        'kelengkapan' => 'required',
    ];

    public function keluhans()
    {
        return $this->hasMany(Keluhan::class, 'id_komputer', 'id_komputer');
    }
}
