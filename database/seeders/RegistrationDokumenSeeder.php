<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegistrationDokumen;

class RegistrationDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistrationDokumen::insert([
            [
                'registration_path_id' => 1,
                'dokumen_name' => 'Ijazah',
                'slug_name' => 'ijazah',
                'description' => 'Scan ijazah asli dalam format PDF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'registration_path_id' => 1,
                'dokumen_name' => 'Kartu Keluarga',
                'slug_name' => 'kartu',
                'description' => 'Scan kartu keluarga dalam format PDF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'registration_path_id' => 1,
                'dokumen_name' => 'Akta Kelahiran',
                'slug_name' => 'akta',
                'description' => 'Scan akta kelahiran dalam format PDF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'registration_path_id' => 2,
                'dokumen_name' => 'Ijazah',
                'slug_name' => 'ijazah',
                'description' => 'Scan ijazah asli dalam format PDF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'registration_path_id' => 2,
                'dokumen_name' => 'Kartu Keluarga',
                'slug_name' => 'kartu',
                'description' => 'Scan kartu keluarga dalam format PDF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'registration_path_id' => 2,
                'dokumen_name' => 'Akta Kelahiran',
                'slug_name' => 'akta',
                'description' => 'Scan akta kelahiran dalam format PDF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
