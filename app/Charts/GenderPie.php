<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

use Illuminate\Support\Facades\DB;

class GenderPie
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Ambil jumlah berdasarkan gender dari tabel personal_data
        $lakiLaki = DB::table('personal_data')->where('gander', 'Laki-laki')->count();
        $perempuan = DB::table('personal_data')->where('gander', 'Perempuan')->count();
        $lainnya = DB::table('personal_data')->whereNotIn('gander', ['Laki-laki', 'Perempuan'])->count();

        return $this->chart->pieChart()
            ->setTitle('Distribusi Jenis Kelamin')
            ->addData([$lakiLaki, $perempuan, $lainnya])
            ->setLabels(['Laki-laki', 'Perempuan', 'Lainnya']);
    }
}