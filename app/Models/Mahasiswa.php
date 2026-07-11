<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'kelas_id',
        'nim',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'angkatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function presensi(): HasMany
    {
        return $this->hasMany(Presensi::class);
    }
}
