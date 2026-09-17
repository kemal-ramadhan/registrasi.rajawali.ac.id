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
        Schema::create('dokumen_firsts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('personal_foto')->nullable();
            $table->text('personal_card')->nullable();
            $table->text('family_foto')->nullable();
            $table->string('family_card')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_firsts');
    }
};
