<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$emailTarget = 'nurunnajahawasalwa@gmail.com';

echo "=========================================================\n";
echo "MEMULAI PENGHAPUSAN AKURAT UNTUK EMAIL: $emailTarget\n";
echo "=========================================================\n";

// 1. Cari User ID
$user = DB::table('users')->where('email', $emailTarget)->first();

if (!$user) {
    echo "[INFO] User dengan email $emailTarget tidak ditemukan di database.\n";
    echo "Proses dihentikan.\n";
    exit;
}

$userId = $user->id;
echo "[DITEMUKAN] User ID: $userId\n\n";

DB::beginTransaction();

try {
    // 2. Hapus Data Turunan Level 2 (Relasi dari relasi)
    // Hapus dari answers dan results (berdasarkan exam_participants_id)
    $examParticipantIds = DB::table('exam_participants')->where('user_id', $userId)->pluck('id');
    if ($examParticipantIds->isNotEmpty()) {
        $deletedAnswers = DB::table('answers')->whereIn('exam_participants_id', $examParticipantIds)->delete();
        $deletedResults = DB::table('results')->whereIn('exam_participants_id', $examParticipantIds)->delete();
        echo "[HAPUS] $deletedAnswers baris dari tabel 'answers'\n";
        echo "[HAPUS] $deletedResults baris dari tabel 'results'\n";
    }

    // Hapus dari document_requirements dan my_registration_tests (berdasarkan program_option_id)
    $programOptionIds = DB::table('program_options')->where('user_id', $userId)->pluck('id');
    if ($programOptionIds->isNotEmpty()) {
        $deletedDocs = DB::table('document_requirements')->whereIn('program_option_id', $programOptionIds)->delete();
        $deletedTests = DB::table('my_registration_tests')->whereIn('program_option_id', $programOptionIds)->delete();
        echo "[HAPUS] $deletedDocs baris dari tabel 'document_requirements'\n";
        echo "[HAPUS] $deletedTests baris dari tabel 'my_registration_tests'\n";
    }

    // Hapus dari mahasiswa_cicilans (berdasarkan mahasiswa_id)
    $mahasiswaIds = DB::table('mahasiswas')->where('user_id', $userId)->pluck('id');
    if ($mahasiswaIds->isNotEmpty()) {
        $deletedCicilan = DB::table('mahasiswa_cicilans')->whereIn('mahasiswa_id', $mahasiswaIds)->delete();
        echo "[HAPUS] $deletedCicilan baris dari tabel 'mahasiswa_cicilans'\n";
    }

    // 3. Hapus Data Relasi Langsung (berdasarkan user_id)
    $tablesWithUserId = [
        'addresses', 'akun_sistems', 'dokumen_firsts', 'education', 
        'exam_participants', 'families', 'incomes', 'mahasiswa_paymants', 
        'mahasiswas', 'nim_mahasiswas', 'paymants', 'pembayaran_b_k_s', 
        'personal_data', 'program_options', 'referals', 'sessions'
    ];

    foreach ($tablesWithUserId as $table) {
        $deleted = DB::table($table)->where('user_id', $userId)->delete();
        if ($deleted > 0) {
            echo "[HAPUS] $deleted baris dari tabel '$table'\n";
        }
    }

    // 4. Hapus Token Reset Password (jika ada)
    $deletedTokens = DB::table('password_reset_tokens')->where('email', $emailTarget)->delete();
    if ($deletedTokens > 0) {
        echo "[HAPUS] $deletedTokens baris dari tabel 'password_reset_tokens'\n";
    }

    // 5. Terakhir, Hapus User Induk
    $deletedUser = DB::table('users')->where('id', $userId)->delete();
    echo "[HAPUS] $deletedUser baris dari tabel 'users'\n";

    DB::commit();
    
    echo "\n=========================================================\n";
    echo "PENGHAPUSAN SUKSES! Seluruh jejak data berhasil dibersihkan.\n";
    echo "=========================================================\n";

} catch (\Exception $e) {
    DB::rollBack();
    echo "\n[ERROR] Terjadi kesalahan: " . $e->getMessage() . "\n";
    echo "Penghapusan dibatalkan (Rollback). Tidak ada data yang hilang.\n";
}
