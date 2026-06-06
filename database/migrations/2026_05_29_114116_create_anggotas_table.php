<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('no_anggota')->unique();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tgl_masuk')->nullable();

            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};