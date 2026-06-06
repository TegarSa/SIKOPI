<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->id();

            $table->string('judul');

            $table->text('isi');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->date('tgl_publish')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};