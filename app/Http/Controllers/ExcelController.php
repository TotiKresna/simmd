<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Student;
use App\Models\TestResult;


// class ExcelController extends Controller
// {
//     public function import(Request $request)
//     {
//         $request->validate([
//             'file' => 'required|mimes:xlsx,xls',
//         ]);

//         try {
//             $file = $request->file('file');

//             // Load file Excel
//             $spreadsheet = IOFactory::load($file);

//             // Ambil sheet pertama
//             $sheet = $spreadsheet->getActiveSheet();

//             $highestRow = $sheet->getHighestRow();
//             $highestColumn = $sheet->getHighestColumn();

//             // Ambil data dari Excel
//             $data = [];
//             for ($row = 2; $row <= $highestRow; $row++) {
//                 $rowData = [];
//                 for ($col = 'A'; $col <= $highestColumn; $col++) {
//                     $cellValue = $sheet->getCell($col . $row)->getValue();
//                     $rowData[] = $cellValue;
//                 }
//                 $data[] = $rowData;
//             }

//             // Proses data
//             foreach ($data as $row) {
//                 $nama = $row[0];
//                 $kelas = $row[1];
//                 $opm_tambah = $row[2];
//                 $opm_kurang = $row[3];
//                 $opm_kali = $row[4];
//                 $opm_bagi = $row[5];

//                 // Cek data kosong
//                 if (empty($nama) || empty($kelas)) {
//                     // Notifikasi error
//                     return redirect()->back()->with('error', 'Nama atau kelas tidak boleh kosong.');
//                 }

//                 // Cari atau buat entri siswa berdasarkan nama dan kelas
//                 $student = Student::updateOrCreate(
//                     ['nama' => $nama, 'kelas' => $kelas],
//                     ['nama' => $nama, 'kelas' => $kelas]
//                 );

//                 // Hitung opm_total
//                 $opm_total = $opm_tambah + $opm_kurang + $opm_kali + $opm_bagi;

//                 // Simpan data ke tabel test_result
//                 TestResult::create([
//                     'student_id' => $student->id,
//                     'opm_tambah' => $opm_tambah,
//                     'opm_kurang' => $opm_kurang,
//                     'opm_kali' => $opm_kali,
//                     'opm_bagi' => $opm_bagi,
//                     'opm_total' => $opm_total,
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ]);
//             }

//             // Notifikasi sukses
//             return redirect()->back()->with('success', 'Data berhasil diimpor.');
//         } catch (\Exception $e) {
//             // Notifikasi error
//             return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
//         }
//     }
// }

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('file');

            // Load file Excel
            $spreadsheet = IOFactory::load($file);

            // Ambil sheet pertama
            $sheet = $spreadsheet->getActiveSheet();

            // Ambil nama kolom dari Excel (baris pertama)
            $columnNames = [];
            $highestColumn = $sheet->getHighestColumn();
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                $cellValue = $sheet->getCell($col . '1')->getValue();
                // Normalisasi nama kolom (ubah ke huruf kecil dan hilangkan spasi dan karakter khusus)
                $columnName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $cellValue));
                $columnNames[] = $columnName;
            }

            // Nama kolom yang diharapkan
            $expectedColumnNames = ['nama', 'kelas', 'opm_tambah', 'opm_kurang', 'opm_kali', 'opm_bagi'];

            // Periksa apakah nama kolom sesuai
            $normalizedExpectedColumnNames = array_map(function($columnName) {
                // Normalisasi nama kolom yang diharapkan
                return strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $columnName));
            }, $expectedColumnNames);

            if (count(array_diff($normalizedExpectedColumnNames, $columnNames)) > 0) {
                return redirect()->back()->with('error', 'Nama kolom tidak sesuai dengan format yang diharapkan.');
            }

            // Proses data jika nama kolom sesuai
            // Ambil data dari Excel
            $data = [];
            for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
                $rowData = [];
                foreach ($expectedColumnNames as $index => $columnName) {
                    $cellValue = $sheet->getCellByColumnAndRow($index + 1, $row)->getValue();
                    $rowData[$columnName] = $cellValue;
                }
                $data[] = $rowData;
            }

            // Lakukan validasi data dan simpan ke database
            foreach ($data as $row) {
                // Cek data kosong pada field nama dan kelas
                if (empty($row['nama']) || empty($row['kelas'])) {
                    continue; // Lewati data jika nama atau kelas kosong
                }

                // Cari atau buat entri siswa berdasarkan nama dan kelas
                $student = Student::updateOrCreate(
                    ['nama' => $row['nama'], 'kelas' => $row['kelas']],
                    ['nama' => $row['nama'], 'kelas' => $row['kelas']]
                );

                // Hitung opm_total
                $opm_total = $row['opm_tambah'] + $row['opm_kurang'] + $row['opm_kali'] + $row['opm_bagi'];

                // Simpan data ke tabel test_result
                TestResult::create([
                    'student_id' => $student->id,
                    'opm_tambah' => $row['opm_tambah'],
                    'opm_kurang' => $row['opm_kurang'],
                    'opm_kali' => $row['opm_kali'],
                    'opm_bagi' => $row['opm_bagi'],
                    'opm_total' => $opm_total,
                ]);
            }

            // Notifikasi sukses
            return redirect()->back()->with('success', 'Data berhasil diimpor.');

        } catch (\Exception $e) {
            // Notifikasi error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}