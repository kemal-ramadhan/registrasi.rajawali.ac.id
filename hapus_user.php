<?php
// Mengintegrasikan sistem dengan kernel utama Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$emailTarget = 'nurunnajahawasalwa@gmail.com';
echo "=========================================================\n";
echo "MEMULAI PENCARIAN UTAMA UNTUK EMAIL: $emailTarget\n";
echo "=========================================================\n";

$tables = DB::select('SHOW TABLES');
$foundRows = [];
$possibleIds = [];

// Langkah 1: Cari baris data di semua tabel yang berisi nilai email tersebut
foreach ($tables as $table) {
    $tableName = current((array)$table);
    
    // Lewati tabel sistem bawaan yang tidak berkaitan dengan data user pendaftaran
    if (in_array($tableName, ['failed_jobs', 'migrations', 'jobs', 'sessions'])) {
        continue;
    }
    
    try {
        $columns = Schema::getColumnListing($tableName);
        foreach ($columns as $column) {
            $records = DB::table($tableName)->where($column, $emailTarget)->get();
            if ($records->isNotEmpty()) {
                foreach ($records as $record) {
                    echo "[EMAIL FOUND] Tabel: $tableName | Kolom: $column\n";
                    
                    // Ambil semua ID potensial untuk pelacakan relasi lebih lanjut
                    if (isset($record->id)) {
                        $possibleIds[] = $record->id;
                    }
                    if (isset($record->user_id)) {
                        $possibleIds[] = $record->user_id;
                    }
                    if (isset($record->pendaftar_id)) {
                        $possibleIds[] = $record->pendaftar_id;
                    }
                    
                    $foundRows[$tableName][] = ['column' => $column, 'value' => $emailTarget];
                }
            }
        }
    } catch (\Exception $e) {
        // Melompati tabel jika terjadi kegagalan pembacaan struktur struktur data
    }
}

// Bersihkan data ID duplikat
$possibleIds = array_unique(array_filter($possibleIds));

// Langkah 2: Cari data di semua tabel yang berelasi menggunakan ID yang ditemukan
if (!empty($possibleIds)) {
    echo "\n=========================================================\n";
    echo "MEMULAI PELACAKAN RELASI BERDASARKAN ID: " . implode(', ', $possibleIds) . "\n";
    echo "=========================================================\n";
    
    foreach ($tables as $table) {
        $tableName = current((array)$table);
        if (in_array($tableName, ['failed_jobs', 'migrations', 'jobs', 'sessions'])) {
            continue;
        }
        
        try {
            $columns = Schema::getColumnListing($tableName);
            foreach ($columns as $column) {
                // Fokus mencari pada nama kolom yang umumnya merupakan kunci relasi (Foreign Key)
                if (preg_match('/(id|user_id|pendaftar_id|mahasiswa_id|akun_id)/i', $column)) {
                    foreach ($possibleIds as $id) {
                        $records = DB::table($tableName)->where($column, $id)->get();
                        if ($records->isNotEmpty()) {
                            echo "[RELATION FOUND] Tabel: $tableName | Kolom: $column dengan ID: $id\n";
                            $foundRows[$tableName][] = ['column' => $column, 'value' => $id];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Melompati tabel jika terjadi kegagalan pembacaan
        }
    }
}

echo "\n=========================================================\n";
echo "MEMULAI PROSES PENGHAPUSAN DATA SECARA TOTAL\n";
echo "=========================================================\n";

if (empty($foundRows)) {
    echo "Tidak ada data yang ditemukan untuk dihapus.\n";
} else {
    // Membalikkan urutan tabel agar data anak (child relation) terhapus lebih dahulu guna menghindari error Foreign Key Constraint
    $foundRowsReversed = array_reverse($foundRows, true);
    
    foreach ($foundRowsReversed as $tableName => $conditions) {
        // Buat kondisi unik agar tidak menghapus baris yang sama berulang kali
        $uniqueConditions = array_map("unserialize", array_unique(array_map("serialize", $conditions)));
        
        foreach ($uniqueConditions as $cond) {
            try {
                $deletedCount = DB::table($tableName)->where($cond['column'], $cond['value'])->delete();
                echo "[DELETED] Berhasil menghapus $deletedCount baris dari tabel [$tableName] (Kondisi: {$cond['column']} = {$cond['value']})\n";
            } catch (\Exception $e) {
                echo "[FAILED] Gagal menghapus dari tabel [$tableName]: " . $e->getMessage() . "\n";
            }
        }
    }
}

echo "\n=========================================================\n";
echo "PROSES SELESAI\n";
echo "=========================================================\n";
