<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LineChart;

class DailyIncomeChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): LineChart
    {
        $period = CarbonPeriod::create(now()->subDays(6)->startOfDay(), now()->endOfDay());

        $dates = collect($period)->map(fn ($date) => $date->format('Y-m-d'));
        $statuses = ['pending', 'success', 'failed'];
        $data = [];

        foreach ($statuses as $status) {
            $data[$status] = $dates->map(function ($date) use ($status) {
                return DB::table('paymants') // masih typo, harusnya 'payments'
                    ->whereDate('created_at', $date)
                    ->where('status', $status)
                    ->sum('amount');
            })->toArray();
        }

        return $this->chart->lineChart()
            ->setTitle('Transaksi Harian')
            ->setSubtitle('7 Hari Terakhir')
            ->addData('Pending', $data['pending'])
            ->addData('Success', $data['success'])
            ->addData('Failed', $data['failed'])
            ->setHeight(200)
            ->setXAxis($dates->map(fn ($d) => Carbon::parse($d)->format('d M'))->toArray());
    }
}
