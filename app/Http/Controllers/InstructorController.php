<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function create()
    {
        return view('instruktur_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'whatsapp' => 'required|string',
        ]);

        Instructor::create($request->all());

        return redirect()->route('instructors.instruktur')->with('success', 'Instruktur berhasil disimpan.');
    }

    public function edit(Instructor $instructor)
    {
        return view('instruktur_edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'whatsapp' => 'required|string',
        ]);

        $instructor->update($request->all());

        return redirect()->route('instructors.instruktur')->with('success', 'Instructor berhasil diperbarui.');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructors.instruktur')->with('success', 'Instructor berhasil dihapus.');
    }

    public function index()
    {
        $instructors = Instructor::all();
        return view('instruktur', compact('instructors'));
    }
}
