<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\ProgramOption;
use App\Models\RegistrationPath;
use App\Models\Paymant;
use App\Models\DocumentRequirement;
use Illuminate\Support\Facades\DB;

$email = 'wildanthoriikulmubarak@gmail.com';
$user = User::where('email', $email)->first();

if (!$user) {
    die("User tidak ditemukan!\n");
}

// 1. Cari ID Jalur PMDK Rapor
$newPath = RegistrationPath::where('name', 'like', '%PMDK Rapor%')->first();
if (!$newPath) {
    die("Jalur 'PMDK Rapor' tidak ditemukan di database!\n");
}

echo "Memproses User: {$user->name} ({$user->email})\n";
echo "Target Jalur: {$newPath->name} (ID: {$newPath->id})\n\n";

// 2. Ambil data pendaftaran (ProgramOption)
$options = ProgramOption::where('user_id', $user->id)->get();

if ($options->count() < 2) {
    die("Data pendaftaran tidak ditemukan atau tidak duplikat. Jumlah data: " . $options->count() . "\n");
}

// Kita asumsikan yang akan dihapus adalah yang pertama ketemu, dan yang diupdate adalah yang terakhir
$toDelete = $options->first();
$toUpdate = $options->last();

echo "Menghapus Pendaftaran ID: {$toDelete->id} (Status: {$toDelete->status})\n";
echo "Mengupdate Pendaftaran ID: {$toUpdate->id} ke Jalur PMDK Rapor\n\n";

DB::transaction(function () use ($toDelete, $toUpdate, $newPath) {
    // Hapus data terkait entri yang akan dihapus
    Paymant::where('program_option_id', $toDelete->id)->delete();
    DocumentRequirement::where('program_option_id', $toDelete->id)->delete();
    $toDelete->delete();

    // Update entri yang dipertahankan
    $toUpdate->update([
        'registration_path_id' => $newPath->id,
        'status' => 'Upload Dokumen' // Reset status agar bisa lanjut ke proses dokumen
    ]);
});

echo "[SUCCESS] Migrasi berhasil! Data duplikat telah dihapus.\n";
echo "=========================================================\n";