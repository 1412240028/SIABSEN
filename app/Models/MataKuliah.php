<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}