<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'anggota_id',
        'jenis',
        'kategori',
        'reference_id',
        'jumlah',
        'saldo_setelah',
        'keterangan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}