<?php
// Mengintegrasikan sistem dengan kernel utama Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=========================================================\n";
echo "MEMULAI PROSES EXPORT RINCIAN PENARIKAN DUITKU KE CSV\n";
echo "=========================================================\n";

// Query mengambil data pembayaran SUCCESS dan detail jalurnya
$query = "
    SELECT 
        paymants.created_at,
        users.name,
        users.email,
        registration_paths.name AS jalur_pendaftaran,
        registration_paths.title AS gelombang,
        departements.name AS program_studi,
        paymants.amount,
        paymants.payment_method,
        paymants.merchant_order_id
    FROM paymants
    INNER JOIN users 
        ON paymants.user_id = users.id
    LEFT JOIN program_options 
        ON program_options.id = paymants.program_option_id
    LEFT JOIN registration_paths 
        ON registration_paths.id = program_options.registration_path_id
    LEFT JOIN departements 
        ON departements.id = program_options.departement_id
    WHERE paymants.status = 'SUCCESS'
    ORDER BY registration_paths.name ASC, paymants.created_at ASC
";

try {
    $results = DB::select($query);
    
    if (empty($results)) {
        echo "Tidak ada data pembayaran SUCCESS yang ditemukan.\n";
        exit;
    }

    // Nama file output CSV
    $fileName = 'Rincian_Penarikan_Duitku_BTH.csv';
    $file = fopen(__DIR__ . '/' . $fileName, 'w');

    // Menambahkan BOM UTF-8 agar Excel membaca karakter khusus dengan benar
    fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Header Kolom CSV (Menggunakan titik koma ';' sebagai pemisah agar rapi di Excel)
    fputcsv($file, [
        'Tanggal Transaksi', 
        'Nama Mahasiswa', 
        'Email', 
        'Jalur Pendaftaran', 
        'Gelombang', 
        'Program Studi', 
        'Metode Pembayaran', 
        'Order ID Duitku', 
        'Nominal (Rp)'
    ], ';');

    // Tulis Data Baris demi Baris
    $totalAmount = 0;
    foreach ($results as $row) {
        fputcsv($file, [
            $row->created_at ?? '-',
            $row->name ?? '-',
            $row->email ?? '-',
            $row->jalur_pendaftaran ?? '-',
            $row->gelombang ?? '-',
            $row->program_studi ?? '-',
            $row->payment_method ?? '-',
            $row->merchant_order_id ?? '-',
            $row->amount ?? 0
        ], ';');
        
        $totalAmount += $row->amount;
    }

    // Tulis Footer untuk Total Keseluruhan
    fputcsv($file, ['', '', '', '', '', '', '', 'TOTAL PENARIKAN', $totalAmount], ';');

    fclose($file);
    
    echo "[SUCCESS] Data rincian berhasil diexport ke CSV!\n";
    echo "[INFO] Silakan download file '$fileName' menggunakan WinSCP dan kirim ke Bu Ulfa (Bisa langsung dibuka di Excel).\n";

} catch (\Exception $e) {
    echo "[ERROR] Terjadi kesalahan: " . $e->getMessage() . "\n";
}

echo "=========================================================\n";
?>