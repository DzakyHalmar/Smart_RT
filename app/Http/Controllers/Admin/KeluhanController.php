<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KeluhanController extends Controller
{
    public function index(): View
    {
        $keluhan = Keluhan::latest()->paginate(10);

        return view('admin.keluhan.index', compact('keluhan'));
    }

    public function update(Request $request, Keluhan $keluhan): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu,Diproses,Selesai'],
        ]);

        $keluhan->update($validated);

        return redirect()
            ->route('admin.keluhan.index')
            ->with('success', 'Status keluhan berhasil diperbarui.');
    }

    public function destroy(Keluhan $keluhan): RedirectResponse
    {
        $keluhan->delete();

        return redirect()
            ->route('admin.keluhan.index')
            ->with('success', 'Keluhan berhasil dihapus.');
    }
}
