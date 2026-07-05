<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomplainPresensi extends Model
{
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function sesiPresensi()
    {
        return $this->belongsTo(SesiPresensi::class);
    }
}
