<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->get();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
        ]);

        $file = $request->file('foto');
        $path = $file->store('galeri', 'public');

        Galeri::create([
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $path,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->path_file) {
            Storage::disk('public')->delete($galeri->path_file);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
