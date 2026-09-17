<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\ProgramOption;
use App\Models\RegistrationPath;
use App\Models\Paymant;

$email = 'wildanthoriikulmubarak@gmail.com'; // Email si Wildan
$user = User::where('email', $email)->first();

if (!$user) {
    die("User tidak ditemukan!\n");
}

// Cari jalur pengabdian (gunakan % agar lebih fleksibel)
$path = RegistrationPath::where('name', 'like', '%Pengabdian%')->first();

if (!$path) {
    die("Jalur Pengabdian tidak ditemukan di database!\n");
}

echo "Target: {$user->name} ({$user->email})\n";
echo "Jalur: {$path->name}\n\n";

// Cari opsi program user pada jalur tersebut
$options = ProgramOption::where('user_id', $user->id)
                        ->where('registration_path_id', $path->id)
                        ->get();

if ($options->isEmpty()) {
    echo "Tidak ada pendaftaran di jalur ini.\n";
} else {
    foreach ($options as $opt) {
        // Hapus pembayaran terkait dulu agar tidak ada orphaned record
        Paymant::where('program_option_id', $opt->id)->delete();
        
        // Hapus program option
        $opt->delete();
        echo "[DELETED] Pendaftaran ID {$opt->id} berhasil dihapus.\n";
    }
    echo "\nSelesai! Data duplikat sudah bersih.\n";
}