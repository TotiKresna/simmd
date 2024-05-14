<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    public function create()
    {
        return view('level_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string',
        ]);

        Level::create($request->all());

        return redirect()->route('levels.level')->with('success', 'Level berhasil disimpan.');
    }

    public function edit(Level $level)
    {
        return view('level_edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'level' => 'required|string',
        ]);

        $level->update($request->all());

        return redirect()->route('levels.level')->with('success', 'Level berhasil diperbarui.');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('levels.level')->with('success', 'Level berhasil dihapus.');
    }

    public function index()
    {
        $levels = Level::all();
        return view('level', compact('levels'));
    }
}
