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
        Schema::create('scema_cicilans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biaya_id');
            $table->text('description');
            $table->string('potongan')->nullable();
            $table->integer('jumlah_cicilan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scema_cicilans');
    }
};
