<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simpanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id')
                ->constrained('anggotas')
                ->onDelete('cascade');

            $table->enum('jenis', [
                'pokok',
                'wajib',
                'sukarela',
                'hari_raya',
                'pendidikan'
            ]);

            $table->decimal('jumlah', 15, 2);

            $table->date('tgl_bayar');

            $table->enum('status_verifikasi', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};