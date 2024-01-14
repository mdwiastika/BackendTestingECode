<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with = ['mata_kuliah'];
    public function mata_kuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
    public function absensi_details()
    {
        return $this->hasMany(AbsensiDetail::class, 'absensi_id', 'id');
    }
}
