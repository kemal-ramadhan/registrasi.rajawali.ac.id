<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\ProgramOption;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RegistrationStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate, $endDate)
    {
        // List status sesuai dengan permintaan
        $labels = [
            'Belum Memilih Program',
            'Upload Dokumen',
            'Pembayaran',
            'Verifikasi Dokumen',
            'Proses Seleksi',
            'Revisi Dokumen',
            'Daftar Ulang',
            'Generate NIM',
            'Lulus'
        ];

        $data = [];

        foreach ($labels as $label) {
            if ($label === 'Belum Memilih Program') {
                // Mencari user Customer yang BELUM memiliki data di tabel program_options sama sekali
                $countCustomerOnly = User::where('role', 'Customer')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                              ->from('program_options')
                              ->whereColumn('program_options.user_id', 'users.id');
                    })
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        return $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                    })
                    ->count();

                // Berjaga-jaga jika status "Belum Memilih Program" juga di-insert ke dalam db tabel program_options
                $countInOption = ProgramOption::where('status', 'Belum Memilih Program')
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        return $query->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                    })
                    ->count();

                $data[] = $countCustomerOnly + $countInOption;
            } else {
                // Menghitung status spesifik dari tabel program_options
                $count = ProgramOption::where('status', $label)
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        return $query->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                    })
                    ->count();

                $data[] = $count;
            }
        }

        $formatStart = Carbon::parse($startDate)->translatedFormat('d F Y');
        $formatEnd = Carbon::parse($endDate)->translatedFormat('d F Y');

        return $this->chart->barChart()
            ->setTitle('Grafik Status Tahapan PMB')
            ->setSubtitle('Rentang: ' . $formatStart . ' s/d ' . $formatEnd)
            ->addData('Jumlah Calon Mahasiswa', $data)
            ->setXAxis($labels)
            ->setColors(['#4f46e5']) // Warna indigo tailwind
            ->setHeight(400)
            ->setGrid();
    }
}