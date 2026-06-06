<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shu extends Model
{
    use HasFactory;

    protected $table = 'shu';

    protected $fillable = [
        'periode_awal',
        'periode_akhir',
        'total_laba',
        'persentase_shu',
        'total_dibagikan',
        'created_by',
    ];

    /**
     * Relasi ke detail SHU (per anggota)
     */
    public function details()
    {
        return $this->hasMany(ShuDetail::class, 'shu_id');
    }
}