<?php

namespace Database\Seeders;

use App\Models\ProgramLevel;
use App\Models\Faculty;
use App\Models\Departement;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegistrationPath;
use App\Models\RegistrationDepartement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ProgramLevel::insert([
        //     [
        //         'title' => 'Program Sarjana (S1)',
        //         'description' => 'Program pendidikan tingkat sarjana yang dirancang untuk membekali mahasiswa dengan dasar teori dan keterampilan praktis di bidangnya.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Program Pasca Sarjana (S2)',
        //         'description' => 'Program pendidikan lanjutan yang diperuntukkan bagi lulusan sarjana yang ingin memperdalam keahlian akademik dan profesional.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Program Doktor (S3)',
        //         'description' => 'Program pendidikan tertinggi yang bertujuan untuk mencetak akademisi dan peneliti yang mampu berkontribusi pada pengembangan ilmu pengetahuan.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Program Profesi',
        //         'description' => 'Program khusus yang dirancang untuk meningkatkan kompetensi profesional di bidang tertentu melalui pendidikan dan pelatihan intensif.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);    
        
        // Faculty::insert([
        //     [
        //         'program_level_id' => 1, // Sesuaikan dengan program level yang tersedia
        //         'name' => 'Fakultas Hukum',
        //         'description' => 'Fakultas Hukum Universitas Pasundan.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'program_level_id' => 2,
        //         'name' => 'Fakultas Teknik',
        //         'description' => 'Fakultas Teknik dengan berbagai program studi unggulan.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'program_level_id' => 3,
        //         'name' => 'Fakultas Ekonomi dan Bisnis',
        //         'description' => 'Fakultas Ekonomi dan Bisnis untuk mencetak wirausahawan handal.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'program_level_id' => 4,
        //         'name' => 'Fakultas Keguruan dan Ilmu Pendidikan',
        //         'description' => 'FKIP untuk mencetak tenaga pendidik profesional.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'program_level_id' => 1,
        //         'name' => 'Fakultas Ilmu Sosial dan Ilmu Politik',
        //         'description' => 'FISIP untuk mereka yang ingin berkecimpung di dunia sosial dan politik.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'program_level_id' => 1,
        //         'name' => 'Fakultas Seni dan Sastra',
        //         'description' => 'Fakultas yang mewadahi kreativitas dalam seni dan sastra.',
        //         'image' => 'default.jpg',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);

        // Departement::create([
        //     'faculty_id' => 1, // Sesuaikan dengan ID fakultas yang ada
        //     'name' => 'Ilmu Hukum',
        //     'description' => 'Departemen yang berfokus pada studi hukum dan peraturan.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // Departement::create([
        //     'faculty_id' => 1,
        //     'name' => 'Teknik Sipil',
        //     'description' => 'Departemen yang mempelajari konstruksi dan infrastruktur.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // Departement::create([
        //     'faculty_id' => 5,
        //     'name' => 'Teknik Mesin',
        //     'description' => 'Departemen yang berfokus pada perancangan mesin dan manufaktur.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // Departement::create([
        //     'faculty_id' => 6,
        //     'name' => 'Manajemen',
        //     'description' => 'Departemen yang membahas strategi bisnis dan manajemen perusahaan.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // Departement::create([
        //     'faculty_id' => 6,
        //     'name' => 'Pendidikan Bahasa Indonesia',
        //     'description' => 'Departemen yang mendidik calon guru Bahasa Indonesia.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // Departement::create([
        //     'faculty_id' => 5,
        //     'name' => 'Ilmu Komunikasi',
        //     'description' => 'Departemen yang membahas teori komunikasi dan media.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // Departement::create([
        //     'faculty_id' => 6,
        //     'name' => 'Sastra Inggris',
        //     'description' => 'Departemen yang berfokus pada sastra dan linguistik Inggris.',
        //     'image' => 'default.jpg',
        //     'status' => 'active',
        // ]);

        // RegistrationPath::create([
        //     'name' => 'Jalur Prestasi',
        //     'title' => 'Pendaftaran Jalur Prestasi',
        //     'description' => 'Jalur ini diperuntukkan bagi calon mahasiswa yang memiliki prestasi akademik maupun non-akademik.',
        //     'image' => 'jalur_prestasi.jpg',
        //     'start_date' => '2025-03-01',
        //     'end_date' => '2025-06-30',
        //     'amount' => '0',
        //     'status' => 'open',
        // ]);

        // RegistrationPath::create([
        //     'name' => 'Jalur Reguler',
        //     'title' => 'Pendaftaran Jalur Reguler',
        //     'description' => 'Jalur ini terbuka bagi seluruh calon mahasiswa yang memenuhi persyaratan umum.',
        //     'image' => 'jalur_reguler.jpg',
        //     'start_date' => '2025-04-01',
        //     'end_date' => '2025-07-31',
        //     'amount' => '250000',
        //     'status' => 'open',
        // ]);

        // RegistrationPath::create([
        //     'name' => 'Gelombang 1',
        //     'title' => 'Pendaftaran Jalur Beasiswa',
        //     'description' => 'Jalur ini ditujukan bagi calon mahasiswa yang ingin mendapatkan beasiswa berdasarkan kriteria tertentu.',
        //     'image' => 'jalur_beasiswa.jpg',
        //     'start_date' => '2025-05-01',
        //     'end_date' => '2025-08-15',
        //     'amount' => '0',
        //     'status' => 'closed',
        // ]);

        // RegistrationDepartement::insert([
        //     [
        //         'registration_path_id' => 1,
        //         'departement_id' => 1,
        //     ],
        //     [
        //         'registration_path_id' => 1,
        //         'departement_id' => 2,
        //     ],
        //     [
        //         'registration_path_id' => 2,
        //         'departement_id' => 1,
        //     ],
        //     [
        //         'registration_path_id' => 2,
        //         'departement_id' => 2,
        //     ],
        //     [
        //         'registration_path_id' => 3,
        //         'departement_id' => 1,
        //     ],
        // ]);
    }
}
