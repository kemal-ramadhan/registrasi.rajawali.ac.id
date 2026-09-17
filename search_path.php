<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\RegistrationPath;

echo "=========================================================\n";
echo "MENCARI JALUR DENGAN KATA KUNCI 'PMDK' ATAU 'RAPOR'\n";
echo "=========================================================\n";

$paths = RegistrationPath::where('name', 'like', '%PMDK%')
    ->orWhere('name', 'like', '%Rapor%')
    ->orWhere('title', 'like', '%PMDK%')
    ->orWhere('title', 'like', '%Rapor%')
    ->get();

if ($paths->isEmpty()) {
    echo "Tidak ditemukan jalur dengan kata kunci 'PMDK' atau 'Rapor'.\n";
    echo "Mencoba menampilkan 10 jalur terbaru saja untuk dicek manual:\n\n";
    $paths = RegistrationPath::latest()->take(10)->get();
}

echo sprintf("%-5s | %-40s | %-20s | %-10s\n", "ID", "Nama Jalur", "Title", "Status");
echo "---------------------------------------------------------\n";

foreach ($paths as $path) {
    echo sprintf("%-5s | %-40s | %-20s | %-10s\n", 
        $path->id, 
        $path->name, 
        $path->title,
        $path->status
    );
}
echo "=========================================================\n";