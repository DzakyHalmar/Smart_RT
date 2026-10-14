<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    public function index()
    {
        $iuran = Iuran::with('warga')
            ->latest()
            ->paginate(10);

        return view('admin.iuran.index', compact('iuran'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();

        return view('admin.iuran.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'jenis_iuran' => 'required|string|max:100',
            'nominal' => 'required|numeric|min:1',
            'tanggal_iuran' => 'required|date',
            'status' => 'required|in:belum_bayar,lunas',
        ]);

        Iuran::create($validated);

        return redirect()
            ->route('admin.iuran.index')
            ->with('success', 'Data iuran berhasil ditambahkan.');
    }

    public function show(Iuran $iuran)
    {
        return redirect()->route('admin.iuran.index');
    }

    public function edit(Iuran $iuran)
    {
        $warga = Warga::orderBy('nama')->get();

        return view('admin.iuran.edit', compact('iuran', 'warga'));
    }

    public function update(Request $request, Iuran $iuran)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'jenis_iuran' => 'required|string|max:100',
            'nominal' => 'required|numeric|min:1',
            'tanggal_iuran' => 'required|date',
            'status' => 'required|in:belum_bayar,lunas',
        ]);

        $iuran->update($validated);

        return redirect()
            ->route('admin.iuran.index')
            ->with('success', 'Data iuran berhasil diperbarui.');
    }

    public function destroy(Iuran $iuran)
    {
        $iuran->delete();

        return redirect()
            ->route('admin.iuran.index')
            ->with('success', 'Data iuran berhasil dihapus.');
    }
}