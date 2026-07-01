<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SesiPresensi extends Model
{
    use HasFactory;

    protected $table = 'sesi_presensi';

    protected $fillable = [
        'jadwal_id',
        'pertemuan_ke',
        'tanggal',
        'token',
        'opened_at',
        'expired_at',
        'closed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'opened_at' => 'datetime',
            'expired_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function presensi(): HasMany
    {
        return $this->hasMany(Presensi::class);
    }
}