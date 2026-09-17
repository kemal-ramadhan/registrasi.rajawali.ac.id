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
        Schema::create('detail_scema_cicilans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scema_cicilan_id');
            $table->string('cicilan_ke');
            $table->integer('nominal');
            $table->date('tengat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_scema_cicilans');
    }
};
