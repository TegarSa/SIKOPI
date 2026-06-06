<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'no_anggota',
        'nama',
        'nip',
        'jabatan',
        'unit_kerja',
        'no_hp',
        'alamat',
        'tgl_masuk',
        'status',
    ];

    protected $casts = [
        'tgl_masuk' => 'date',
    ];
}