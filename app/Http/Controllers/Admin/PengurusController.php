<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::latest()->paginate(10);

        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
        ]);

        Pengurus::create($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        return redirect()->route('admin.pengurus.index');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
        ]);

        $pengurus->update($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        $pengurus->delete();

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }
}