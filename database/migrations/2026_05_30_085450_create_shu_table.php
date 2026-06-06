<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shu', function (Blueprint $table) {
            $table->id();

            $table->date('periode_awal');
            $table->date('periode_akhir');

            $table->decimal('total_laba', 15, 2);
            $table->decimal('persentase_shu', 5, 2);

            $table->decimal('total_dibagikan', 15, 2);

            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shu');
    }
};