<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pinjaman_id')
                ->constrained('pinjamans')
                ->onDelete('cascade');

            $table->integer('angsuran_ke'); 

            $table->decimal('jumlah_bayar', 15, 2);

            $table->decimal('sisa_pinjaman', 15, 2)->nullable();

            $table->date('tgl_bayar');

            $table->enum('status_verifikasi', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};