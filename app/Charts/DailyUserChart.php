<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DailyUserChart
{
    protected $chart;


    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }


   public function build(int $month, int $year)
    {
        // Menentukan jumlah hari dalam bulan dan tahun yang dipilih
        $daysInMonth = Carbon::createFromDate($year, $month)->daysInMonth;
        
        $data = [];
        $labels = [];

        // Looping untuk mendapatkan data per hari
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($year, $month, $i)->format('Y-m-d');
            
            // Query untuk menghitung jumlah pendaftar di tanggal tersebut
            $count = User::where('role', 'Customer')
                ->whereDate('created_at', $date)
                ->count();
                
            $data[] = $count;
            // Format label sumbu X menjadi dua digit (01, 02, 03, dst)
            $labels[] = str_pad($i, 2, '0', STR_PAD_LEFT); 
        }

        // Mengambil nama bulan untuk subtitle
        $monthName = Carbon::createFromDate($year, $month)->translatedFormat('F');

        return $this->chart->lineChart()
            ->setTitle('Registrasi User Harian')
            // Di sini kita masukkan dinamis $monthName dan $year agar teksnya berubah
            ->setSubtitle('Bulan ' . $monthName . ' ' . $year) 
            ->addData('Pendaftar', $data)
            ->setXAxis($labels)
            ->setColors(['#3b82f6']) // Warna biru sesuai dengan yang ada di gambar kamu
            ->setGrid();
    }}
