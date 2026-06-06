<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'simpanans';

    protected $fillable = [
        'anggota_id',
        'jenis',
        'jumlah',
        'tgl_bayar',
        'status_verifikasi',
        'verified_by',
        'keterangan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}