<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\RegistrationPath;

echo "=========================================================\n";
echo "DAFTAR JALUR PENDAFTARAN YANG ADA DI DATABASE:\n";
echo "=========================================================\n";
echo sprintf("%-5s | %-40s | %-15s\n", "ID", "Nama Jalur", "Status");
echo "---------------------------------------------------------\n";

$paths = RegistrationPath::all();

foreach ($paths as $path) {
    echo sprintf("%-5s | %-40s | %-15s\n", 
        $path->id, 
        $path->name, 
        $path->status
    );
}
echo "=========================================================\n";