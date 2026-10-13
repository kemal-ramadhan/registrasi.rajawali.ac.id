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
        Schema::create('nim_sequences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departement_id')->constrained('departements')->cascadeOnDelete();
            $table->string('year', 2); // 24
            $table->string('registration_path_code', 2); // 1
            $table->unsignedInteger('last_number')->default(0);
            $table->timestamps();

            $table->unique([
                'departement_id', // ✅ BENAR
                'year',
                'registration_path_code'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nim_sequences');
    }
};
