<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = [
        'sesi_presensi_id',
        'mahasiswa_id',
        'status',
        'metode',
        'waktu_presensi',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_presensi' => 'datetime',
        ];
    }

    public function sesiPresensi(): BelongsTo
    {
        return $this->belongsTo(SesiPresensi::class);
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}