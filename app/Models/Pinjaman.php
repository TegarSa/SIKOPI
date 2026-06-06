<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';

    protected $fillable = [
        'anggota_id',
        'jumlah_pinjaman',
        'tenor_bulan',
        'bunga_flat',
        'total_kewajiban',
        'angsuran_perbulan',
        'sisa_pinjaman',
        'status',
        'is_dicairkan', 
        'tgl_pengajuan',
        'tgl_disetujui',
        'approved_by',
        'keterangan',
    ];

    protected $casts = [
        'tgl_pengajuan' => 'date',
        'tgl_disetujui' => 'date',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id');
    }
}