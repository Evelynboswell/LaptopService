<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sparepart', function (Blueprint $table) {
            $table->id('id_sparepart');
            $table->string('jenis_sparepart', 255);
            $table->string('merek_sparepart', 255);
            $table->string('model_sparepart', 255);
            $table->decimal('harga_sparepart', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sparepart');
    }
};
