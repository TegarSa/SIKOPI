<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shu_detail', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shu_id')
                ->constrained('shu')
                ->onDelete('cascade');

            $table->foreignId('anggota_id')
                ->constrained('anggotas')
                ->onDelete('cascade');

            $table->decimal('jumlah_shu', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shu_detail');
    }
};