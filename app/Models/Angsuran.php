<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsuran';

    protected $fillable = [
        'pinjaman_id',
        'anggota_id',
        'angsuran_ke',
        'jumlah_bayar',
        'sisa_pinjaman',
        'tgl_bayar',
        'status_verifikasi',
        'verified_by',
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}