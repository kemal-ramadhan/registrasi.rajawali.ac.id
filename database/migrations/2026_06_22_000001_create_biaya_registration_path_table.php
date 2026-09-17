<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel pivot many-to-many antara Biaya dan RegistrationPath.
     * - Mendukung 1 biaya untuk banyak jalur (mis. "Jaket Almamater" sama untuk semua jalur)
     * - Mendukung 1 biaya untuk 1 jalur spesifik (mis. "Her-Registrasi PMDK" beda nominal/row dari jalur lain)
     * - Kolom tengat_akhir di sini meng-override tengat_akhir default di tabel `biayas`,
     *   sehingga deadline bisa diset manual berbeda per kombinasi biaya+jalur.
     */
    public function up(): void
    {
        Schema::create('biaya_registration_path', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biaya_id')->constrained('biayas')->onDelete('cascade');
            $table->foreignId('registration_path_id')->constrained('registration_paths')->onDelete('cascade');
            $table->date('tengat_akhir')->nullable()
                ->comment('Override tengat_akhir biayas.tengat_akhir untuk kombinasi jalur ini. Null = pakai default dari biayas.');
            $table->timestamps();

            $table->unique(['biaya_id', 'registration_path_id'], 'biaya_path_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_registration_path');
    }
};
