<?php
// Mengintegrasikan sistem dengan kernel utama Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\ProgramOption;
use App\Models\Mahasiswa;
use App\Models\Departement;

echo "=========================================================\n";
echo "TOOLS UBAH PROGRAM STUDI / JENJANG (D3 <-> S1)\n";
echo "=========================================================\n";

// Meminta input email secara interaktif di terminal
$email = trim(readline("Masukkan Email Pendaftar: "));
$user = User::where('email', $email)->first();

if (!$user) {
    die("[ERROR] Pendaftar dengan email '$email' tidak ditemukan.\n");
}

$po = ProgramOption::where('user_id', $user->id)->first();
if (!$po) {
    die("[ERROR] Pendaftar belum memiliki data Program Option.\n");
}

// Menampilkan data saat ini
$currentDept = Departement::with('faculty.programLevel')->find($po->departement_id);
echo "\n[DATA SAAT INI]\n";
echo "Nama: {$user->name}\n";
echo "Prodi: {$currentDept->name} (" . $currentDept->faculty->programLevel->title . ")\n";

// Menampilkan semua prodi untuk dipilih
echo "\n[DAFTAR PRODI TERSEDIA]\n";
$departments = Departement::with('faculty.programLevel')->get();
foreach ($departments as $dept) {
    echo "ID: {$dept->id} | {$dept->name} (" . $dept->faculty->programLevel->title . ")\n";
}

echo "\n";
// Meminta ID tujuan
$newDeptId = trim(readline("Masukkan ID Prodi Baru (Ketik 0 atau biarkan kosong untuk batal): "));

if (empty($newDeptId) || $newDeptId == '0') {
    echo "[INFO] Operasi dibatalkan.\n";
    exit;
}

$targetDept = Departement::find($newDeptId);
if (!$targetDept) {
    die("[ERROR] ID Prodi tidak valid.\n");
}

// Eksekusi Update di kedua tabel krusial
$po->update(['departement_id' => $newDeptId]);
Mahasiswa::where('user_id', $user->id)->update(['departement_id' => $newDeptId]);

echo "[SUCCESS] Data berhasil diubah menjadi jenjang S1: {$targetDept->name}\n";
echo "=========================================================\n";