<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgeBarChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $today = Carbon::today();

        // Definisikan kelompok umur 5 tahunan
        $ageGroups = [
            '15-19', '20-24', '25-29', '30-34',
            '35-39', '40-44', '45-49', '50-54', '55-59', '60+'
        ];

        // Gender yang ingin ditampilkan
        $genderGroups = ['Laki-laki', 'Perempuan'];

        // Siapkan struktur awal data per gender
        $dataByGender = [
            'Laki-laki' => array_fill_keys($ageGroups, 0),
            'Perempuan' => array_fill_keys($ageGroups, 0),
        ];

        foreach ($genderGroups as $gender) {
            $records = DB::table('personal_data')
                ->where('gander', $gender)
                ->whereNotNull('date_of_birth')
                ->get();

            foreach ($records as $item) {
                $age = Carbon::parse($item->date_of_birth)->diffInYears($today);

                $group = match (true) {
                    $age >= 15 && $age <= 19 => '15-19',
                    $age >= 20 && $age <= 24 => '20-24',
                    $age >= 25 && $age <= 29 => '25-29',
                    $age >= 30 && $age <= 34 => '30-34',
                    $age >= 35 && $age <= 39 => '35-39',
                    $age >= 40 && $age <= 44 => '40-44',
                    $age >= 45 && $age <= 49 => '45-49',
                    $age >= 50 && $age <= 54 => '50-54',
                    $age >= 55 && $age <= 59 => '55-59',
                    default => '60+',
                };

                $dataByGender[$gender][$group]++;
            }
        }

        // Buat chart dengan dua seri data (Laki-laki dan Perempuan)
        return $this->chart->barChart()
            ->setTitle('Kelompok Umur per Jenis Kelamin')
            ->addData('Laki-laki', array_values($dataByGender['Laki-laki']))
            ->addData('Perempuan', array_values($dataByGender['Perempuan']))
            ->setXAxis($ageGroups)
            ->setColors(['#3B82F6', '#EC4899']); // Biru & Pink
    }
}