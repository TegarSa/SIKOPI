<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuDetail extends Model
{
    use HasFactory;

    protected $table = 'shu_detail';

    protected $fillable = [
        'shu_id',
        'anggota_id',
        'jumlah_shu',
    ];

    /**
     * Relasi ke SHU utama
     */
    public function shu()
    {
        return $this->belongsTo(Shu::class, 'shu_id');
    }

    /**
     * Relasi ke anggota
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}