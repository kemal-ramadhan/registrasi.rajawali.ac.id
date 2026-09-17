<?php
// Mengintegrasikan sistem dengan kernel utama Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=========================================================\n";
echo "MEMULAI PROSES EXPORT DATA PEMBAYARAN KE TXT\n";
echo "=========================================================\n";

$query = "
    SELECT 
        mahasiswa_paymants.created_at,
        users.name,
        registration_paths.name AS registration_path,
        registration_paths.title,
        departements.name AS departement_name,
        mahasiswa_paymants.amount,
        mahasiswa_paymants.status
    FROM mahasiswa_paymants
    INNER JOIN users 
        ON mahasiswa_paymants.user_id = users.id
    LEFT JOIN program_options 
        ON program_options.id = (
            SELECT po.id
            FROM program_options po
            WHERE po.user_id = users.id
            AND po.status = 'LULUS'
            LIMIT 1
        )
    LEFT JOIN registration_paths 
        ON registration_paths.id = program_options.registration_path_id
    LEFT JOIN departements 
        ON departements.id = program_options.departement_id
    WHERE mahasiswa_paymants.status = 'SUCCESS'
";

try {
    $results = DB::select($query);
    
    if (empty($results)) {
        echo "Tidak ada data pembayaran SUCCESS yang ditemukan.\n";
        exit;
    }

    // Nama file output
    $fileName = 'data_pembayaran_mahasiswa.txt';
    $file = fopen(__DIR__ . '/' . $fileName, 'w');

    // Tulis Header Kolom
    $header = sprintf("%-22s | %-30s | %-30s | %-15s | %-25s | %-15s | %-10s\n", 
        "Tanggal", "Nama", "Jalur Pendaftaran", "Gelombang", "Program Studi", "Nominal (Rp)", "Status"
    );
    fwrite($file, $header);
    fwrite($file, str_repeat("-", 160) . "\n");

    // Tulis Data Baris demi Baris
    $totalAmount = 0;
    foreach ($results as $row) {
        $line = sprintf("%-22s | %-30s | %-30s | %-15s | %-25s | %-15s | %-10s\n",
            $row->created_at ?? '-',
            substr($row->name, 0, 30),
            substr($row->registration_path ?? '-', 0, 30),
            substr($row->title ?? '-', 0, 15),
            substr($row->departement_name ?? '-', 0, 25),
            number_format($row->amount, 0, ',', '.'),
            $row->status
        );
        fwrite($file, $line);
        $totalAmount += $row->amount;
    }

    // Tulis Footer / Total
    fwrite($file, str_repeat("=", 160) . "\n");
    fwrite($file, sprintf("%-133s | %-15s |\n", "TOTAL PENDAPATAN", number_format($totalAmount, 0, ',', '.')));

    fclose($file);
    
    echo "[SUCCESS] Data berhasil diexport!\n";
    echo "[INFO] Silakan download file '$fileName' menggunakan WinSCP.\n";

} catch (\Exception $e) {
    echo "[ERROR] Terjadi kesalahan: " . $e->getMessage() . "\n";
}

echo "=========================================================\n";
?>