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
        Schema::create('pembayaran_b_k_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('program_option_id')->nullable();
            $table->foreignId('referal_id')->nullable();
            $table->integer('nominal');
            $table->string('type')->nullable();
            $table->string('status_approve')->nullable();
            $table->string('status_keuangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_b_k_s');
    }
};
