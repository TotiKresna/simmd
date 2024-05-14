<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TestResult;


class DashboardController extends Controller
{
    //
    // Method untuk mendapatkan data histogram untuk suatu opm
    private function getOpmHistogramData($opmField)
    {
        $opmData = [];

        // Buat rentang nilai opm
        $ranges = [
            ['label' => '0-10'  , 'min' => 0, 'max' => 10],
            ['label' => '10-20', 'min' => 10, 'max' => 20],
            ['label' => '20-30', 'min' => 20, 'max' => 30],
            ['label' => '30-40', 'min' => 30, 'max' => 40],
            ['label' => '40-50', 'min' => 40, 'max' => 50],
            ['label' => '50-60', 'min' => 50, 'max' => 60],
            ['label' => '60-70', 'min' => 60, 'max' => 70],
            ['label' => '70+'  , 'min' => 70, 'max' => 200],
        ];

        // Query untuk menghitung jumlah siswa berdasarkan rentang nilai opm
        foreach ($ranges as $range) {
            $count = DB::table('test_results')
                ->whereBetween($opmField, [$range['min'], $range['max']])
                ->count();

            $opmData[] = $count;
        }

        return $opmData;
    }
    public function index()
    {
        // Ambil data dari database menggunakan query builder
        $opmTambahDataHist = $this->getOpmHistogramData('opm_tambah');
        $opmKurangDataHist = $this->getOpmHistogramData('opm_kurang');
        $opmKaliDataHist = $this->getOpmHistogramData('opm_kali');
        $opmBagiDataHist = $this->getOpmHistogramData('opm_bagi');

        // Kirim data ke view

        // Ambil data opm dari tabel test_results
        $testResults = TestResult::all();

        // // Inisialisasi variabel untuk menyimpan data OPM
        $opmTambahData = [];
        $opmKurangData = [];
        $opmKaliData = [];
        $opmBagiData = [];

        // // Loop melalui data test results untuk mengumpulkan data OPM
        foreach ($testResults as $testResult) {
            $opmTambahData[] = $testResult->opm_tambah;
            $opmKurangData[] = $testResult->opm_kurang;
            $opmKaliData[] = $testResult->opm_kali;
            $opmBagiData[] = $testResult->opm_bagi;
        }

        // Inisialisasi variabel total peserta dan total nilai untuk setiap jenis OPM
        $totalPesertaTambah = 0;
        $totalNilaiTambah = 0;

        $totalPesertaKurang = 0;
        $totalNilaiKurang = 0;

        $totalPesertaKali = 0;
        $totalNilaiKali = 0;

        $totalPesertaBagi = 0;
        $totalNilaiBagi = 0;

        // Loop melalui data hasil tes
        foreach ($testResults as $testResult) {
            // OPM Tambah
            if ($testResult->opm_tambah > 0) {
                $totalPesertaTambah++;
                $totalNilaiTambah += $testResult->opm_tambah;
            }

            // OPM Kurang
            if ($testResult->opm_kurang > 0) {
                $totalPesertaKurang++;
                $totalNilaiKurang += $testResult->opm_kurang;
            }

            // OPM Kali
            if ($testResult->opm_kali > 0) {
                $totalPesertaKali++;
                $totalNilaiKali += $testResult->opm_kali;
            }

            // OPM Bagi
            if ($testResult->opm_bagi > 0) {
                $totalPesertaBagi++;
                $totalNilaiBagi += $testResult->opm_bagi;
            }
        }

        // Hitung rata-rata untuk setiap jenis OPM
        $averageTambah = $totalPesertaTambah > 0 ? $totalNilaiTambah / $totalPesertaTambah : 0;
        $averageKurang = $totalPesertaKurang > 0 ? $totalNilaiKurang / $totalPesertaKurang : 0;
        $averageKali = $totalPesertaKali > 0 ? $totalNilaiKali / $totalPesertaKali : 0;
        $averageBagi = $totalPesertaBagi > 0 ? $totalNilaiBagi / $totalPesertaBagi : 0;

        // Hitung nilai tertinggi & terendah untuk setiap jenis OPM
        $maxTambah = $totalNilaiTambah > 0 ? max($opmTambahData) : 0;
        $minTambah = $totalNilaiTambah > 0 ? min($opmTambahData) : 0;

        $maxKurang = $totalNilaiKurang > 0 ? max($opmKurangData) : 0;
        $minKurang = $totalNilaiKurang > 0 ? min($opmKurangData) : 0;

        $maxKali = $totalNilaiKali > 0 ? max($opmKaliData) : 0;
        $minKali = $totalNilaiKali > 0 ? min($opmKaliData) : 0;

        $maxBagi = $totalNilaiBagi > 0 ? max($opmBagiData) : 0;
        $minBagi = $totalNilaiBagi > 0 ? min($opmBagiData) : 0;

        return view('dashboardtoti', compact(
            'opmTambahDataHist',
            'opmKurangDataHist',
            'opmKaliDataHist',
            'opmBagiDataHist',
            'maxTambah',
            'minTambah',
            'maxKurang',
            'minKurang',
            'maxKali',
            'minKali',
            'maxBagi',
            'minBagi',
            'totalPesertaTambah',
            'totalPesertaKurang',
            'totalPesertaKali',
            'totalPesertaBagi',
            'averageTambah',
            'averageKurang',
            'averageKali',
            'averageBagi',
        ));
    }
}
