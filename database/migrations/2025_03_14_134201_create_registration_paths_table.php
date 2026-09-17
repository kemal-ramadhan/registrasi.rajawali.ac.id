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
        Schema::create('registration_paths', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('code_year')->unique()->nullable();
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->text('image');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('amount');
            $table->text('link_grup')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_paths');
    }
};
