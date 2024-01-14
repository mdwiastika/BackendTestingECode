<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $with = ['universitas'];
    public function universitas()
    {
        return $this->belongsTo(Universitas::class);
    }
}
