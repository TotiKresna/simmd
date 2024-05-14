<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResult;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class TestResultController extends Controller
{

    // Menampilkan form untuk membuat hasil tes baru
    public function create()
    {
        $students = Student::all();
        return view('result_form', compact('students'));
    }

    // Menampilkan form untuk mengedit hasil tes
    public function edit($id)
    {
        $testResult = TestResult::findOrFail($id);
        $students = Student::all();
        return view('result_edit', compact('testResult', 'students'));
    }

    // Menampilkan semua hasil tes
    public function index()
    {
        $testResults = DB::table('test_results')
        ->orderBy('opm_total', 'desc') // Urutkan berdasarkan opm_total secara descending
        ->with('student')
        ->first(); // Ambil entri pertama


        return view('result', compact('testResults'));
    }

    // Menyimpan hasil tes baru
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'kelas' => 'required|string',
        'opm_tambah' => 'nullable|string',
        'opm_kurang' => 'nullable|string',
        'opm_kali' => 'nullable|string',
        'opm_bagi' => 'nullable|string',
    ]);

    // Menyimpan data siswa baru jika belum ada
    $student = Student::firstOrCreate([
        'nama' => $request->nama,
        'kelas' => $request->kelas,
    ]);

    // Mengonversi koma menjadi titik untuk opm
    $opm_tambah = $request->opm_tambah !== null ? str_replace(',', '.', $request->opm_tambah) : null;
    $opm_kurang = $request->opm_kurang !== null ? str_replace(',', '.', $request->opm_kurang) : null;
    $opm_kali = $request->opm_kali !== null ? str_replace(',', '.', $request->opm_kali) : null;
    $opm_bagi = $request->opm_bagi !== null ? str_replace(',', '.', $request->opm_bagi) : null;

    // Validasi numeric setelah konversi koma menjadi titik
    $request->merge([
        'opm_tambah' => $opm_tambah,
        'opm_kurang' => $opm_kurang,
        'opm_kali' => $opm_kali,
        'opm_bagi' => $opm_bagi,
    ]);

    $request->validate([
        'opm_tambah' => 'nullable|numeric',
        'opm_kurang' => 'nullable|numeric',
        'opm_kali' => 'nullable|numeric',
        'opm_bagi' => 'nullable|numeric',
    ]);

    // Menghitung total opm
    $opm_total = array_sum(array_filter([$opm_tambah, $opm_kurang, $opm_kali, $opm_bagi]));

    // Menyimpan hasil tes
    TestResult::create([
        'student_id' => $student->id,
        'opm_tambah' => $opm_tambah,
        'opm_kurang' => $opm_kurang,
        'opm_kali' => $opm_kali,
        'opm_bagi' => $opm_bagi,
        'opm_total' => $opm_total,
    ]);

    return redirect()->back()->with('success', 'Hasil tes berhasil disimpan.');
}


    // Membaca hasil tes berdasarkan ID
    public function readById($id)
    {
        $testResult = TestResult::with('student')->findOrFail($id);
        $student = $testResult->student;
        $testResults = TestResult::where('student_id', $student->id)->get();

        return view('sawang', compact('testResult','testResults'));
    }

    // Mengupdate hasil tes berdasarkan ID
    public function updateById(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string',
        'kelas' => 'required|string',
        'opm_tambah' => 'nullable|string',
        'opm_kurang' => 'nullable|string',
        'opm_kali' => 'nullable|string',
        'opm_bagi' => 'nullable|string',
    ]);

    // Mengupdate data siswa jika perlu
    $student = Student::firstOrCreate([
        'nama' => $request->nama,
        'kelas' => $request->kelas,
    ]);

    if (!$student->wasRecentlyCreated) {
        $student->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);
    }

    // Mengonversi koma menjadi titik untuk opm
    $opm_tambah = $request->opm_tambah !== null ? str_replace(',', '.', $request->opm_tambah) : null;
    $opm_kurang = $request->opm_kurang !== null ? str_replace(',', '.', $request->opm_kurang) : null;
    $opm_kali = $request->opm_kali !== null ? str_replace(',', '.', $request->opm_kali) : null;
    $opm_bagi = $request->opm_bagi !== null ? str_replace(',', '.', $request->opm_bagi) : null;

    // Validasi numeric setelah konversi koma menjadi titik
    $request->merge([
        'opm_tambah' => $opm_tambah,
        'opm_kurang' => $opm_kurang,
        'opm_kali' => $opm_kali,
        'opm_bagi' => $opm_bagi,
    ]);

    $request->validate([
        'opm_tambah' => 'nullable|numeric',
        'opm_kurang' => 'nullable|numeric',
        'opm_kali' => 'nullable|numeric',
        'opm_bagi' => 'nullable|numeric',
    ]);

    // Menghitung total opm
    $opm_total = array_sum(array_filter([$opm_tambah, $opm_kurang, $opm_kali, $opm_bagi]));

    // Mengupdate hasil tes
    DB::table('test_results')
        ->where('id', $id)
        ->update([
            'student_id' => $student->id,
            'opm_tambah' => $opm_tambah,
            'opm_kurang' => $opm_kurang,
            'opm_kali' => $opm_kali,
            'opm_bagi' => $opm_bagi,
            'opm_total' => $opm_total,
            'updated_at' => now(),
        ]);

    return redirect()->back()->with('success', 'Hasil tes berhasil diperbarui.');
}

    // Menghapus data yang dipilih
    public function deleteSelected(Request $request)
{
    $selectedIds = $request->input('selected_ids');

    TestResult::whereIn('id', $selectedIds)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
}
}
