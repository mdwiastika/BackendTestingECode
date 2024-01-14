<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDetail extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with = ['absensi', 'mahasiswa'];
    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'id');
    }
}
