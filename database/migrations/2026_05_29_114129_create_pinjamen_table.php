<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id')
                ->constrained('anggotas')
                ->onDelete('cascade');

            $table->decimal('jumlah_pinjaman', 15, 2);

            // FIX: maksimal 36 bulan (aturan koperasi kamu)
            $table->integer('tenor_bulan')->default(36);

            // bunga flat (misalnya per tahun atau per bulan, kamu tentukan di sistem)
            $table->decimal('bunga_flat', 5, 2)->default(0);

            // hasil perhitungan sistem (WAJIB ada)
            $table->decimal('total_kewajiban', 15, 2);

            $table->decimal('angsuran_perbulan', 15, 2);

            $table->decimal('sisa_pinjaman', 15, 2)->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'aktif',
                'lunas',
                'ditolak'
            ])->default('pending');

            $table->date('tgl_pengajuan');

            $table->date('tgl_disetujui')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};