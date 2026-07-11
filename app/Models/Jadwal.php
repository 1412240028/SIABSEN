<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal';

    protected $fillable = [
        'dosen_id',
        'kelas_id',
        'mata_kuliah_id',
        'semester',
        'tahun_ajaran',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function sesiPresensi(): HasMany
    {
        return $this->hasMany(SesiPresensi::class);
    }
}
