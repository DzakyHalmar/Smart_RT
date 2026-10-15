<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::latest('tanggal_pengeluaran')
            ->paginate(10);

        $totalPengeluaran = Pengeluaran::sum('nominal');

        return view('admin.pengeluaran.index', compact(
            'pengeluaran',
            'totalPengeluaran'
        ));
    }

    public function create()
    {
        return view('admin.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1',
            'tanggal_pengeluaran' => 'required|date',
            'kategori' => 'required|string|max:100',
        ]);

        Pengeluaran::create($validated);

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return redirect()->route('admin.pengeluaran.index');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('admin.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1',
            'tanggal_pengeluaran' => 'required|date',
            'kategori' => 'required|string|max:100',
        ]);

        $pengeluaran->update($validated);

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}