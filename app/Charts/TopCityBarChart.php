<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class TopCityBarChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Ambil 10 kota dengan jumlah pendaftar terbanyak
        $topCities = DB::table('addresses')
            ->select('city', DB::raw('COUNT(*) as total'))
            ->groupBy('city')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $labels = $topCities->pluck('city')->toArray();
        $data = $topCities->pluck('total')->toArray();

        return $this->chart->barChart()
            ->setTitle('10 Kota Asal Pendaftar Terbanyak')
            ->addData('Jumlah Pendaftar', $data)
            ->setXAxis($labels)
            ->setHeight(400);
    }
}