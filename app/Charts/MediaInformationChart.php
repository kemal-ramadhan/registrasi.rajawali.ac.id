<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MediaInformationChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Ambil data media_information dan hitung jumlah masing-masing sumber
        $mediaData = DB::table('personal_data')
            ->select('media_information', DB::raw('COUNT(*) as total'))
            ->whereNotNull('media_information')
            ->groupBy('media_information')
            ->orderByDesc('total')
            ->get();

        // Siapkan label dan data
        $labels = $mediaData->pluck('media_information')->toArray();
        $values = $mediaData->pluck('total')->toArray();

        return $this->chart->pieChart()
            ->setTitle('Asal Informasi Media Pendaftar')
            ->setSubtitle('Distribusi berdasarkan sumber informasi yang diisi pendaftar')
            ->addData($values)
            ->setLabels($labels)
            ->setColors([
                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#06B6D4'
            ]);
    }
}