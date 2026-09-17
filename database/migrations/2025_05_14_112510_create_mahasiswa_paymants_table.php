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
        Schema::create('mahasiswa_paymants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('mahasiswa_id')->nullable();
            $table->foreignId('biaya_id');
            $table->foreignId('scema_cicilan_id')->nullable();
            $table->foreignId('detail_scema_cicilan_id')->nullable();
            $table->string('transaction_id')->unique()->nullable();
            $table->string('merchant_order_id')->unique()->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('amount');
            $table->string('status')->default('pending'); // pending, success, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_paymants');
    }
};
