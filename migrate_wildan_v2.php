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

echo "=========================================================\n";
echo "TOOLS MIGRASI & PEMBERSIHAN DATA PENDAFTAR\n";
echo "=========================================================\n";

// 1. Cari User
$nama = readline("Masukkan Nama Lengkap Pendaftar: ");
$user = User::where('name', 'like', "%$nama%")->first();

if (!$user) {
    die("User dengan nama '$nama' tidak ditemukan!\n");
}

echo "\nDitemukan: {$user->name} (ID: {$user->id})\n";

// 2. Tampilkan semua pendaftarannya
$options = ProgramOption::with('registrationPath')->where('user_id', $user->id)->get();
if ($options->isEmpty()) {
    die("Pendaftar ini belum memiliki data pendaftaran (ProgramOption).\n");
}

echo "\nDAFTAR PENDAFTARAN SAAT INI:\n";
foreach ($options as $opt) {
    echo "ID: {$opt->id} | Jalur: " . ($opt->registrationPath->name ?? '-') . " | Status: {$opt->status}\n";
}

// 3. Input Aksi
echo "\n";
$deleteId = readline("Masukkan ID yang ingin DIHAPUS (kosongkan jika tidak ada): ");
$updateId = readline("Masukkan ID yang ingin DIPINDAHKAN jalurnya: ");
$targetPathId = readline("Masukkan ID Jalur Tujuan (sesuai list_paths.php): ");

DB::transaction(function () use ($deleteId, $updateId, $targetPathId) {
    // Proses Hapus
    if (!empty($deleteId)) {
        Paymant::where('program_option_id', $deleteId)->delete();
        DocumentRequirement::where('program_option_id', $deleteId)->delete();
        ProgramOption::where('id', $deleteId)->delete();
        echo "[INFO] Data ID $deleteId berhasil dihapus.\n";
    }

    // Proses Pindah Jalur
    if (!empty($updateId) && !empty($targetPathId)) {
        $opt = ProgramOption::find($updateId);
        if ($opt) {
            $opt->update([
                'registration_path_id' => $targetPathId,
                'status' => 'Upload Dokumen'
            ]);
            echo "[INFO] Data ID $updateId berhasil dipindahkan ke Jalur ID $targetPathId.\n";
        }
    }
});

echo "\n[SUCCESS] Pemrosesan data selesai.\n";
echo "=========================================================\n";