<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KeluhanController extends Controller
{
    
    public function index(): View
    {
        $keluhan = Keluhan::latest()->get();

        return view('public.keluhan', compact('keluhan'));
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
        ]);

        Keluhan::create($validated);

        return redirect()
            ->route('keluhan')
            ->with('success', 'Keluhan berhasil dikirim kepada pengurus RT.');
    }
}
