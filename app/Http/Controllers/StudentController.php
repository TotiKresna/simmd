<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function create()
    {
        return view('murid_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required|string',
        ]);

        Student::create($request->all());

        return redirect()->route('students.murid')->with('success', 'Siswa berhasil disimpan.');
    }

    public function edit(Student $student)
    {
        return view('murid_edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required|string',
        ]);

        $student->update($request->all());

        return redirect()->route('students.murid')->with('success', 'Student berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.murid')->with('success', 'Student berhasil dihapus.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
        Student::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function index()
    {
        $students = Student::all();
        return view('murid', compact('students'));
    }
}
