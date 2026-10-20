<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index()
    {
        $search = request('search');

        $wargas = Warga::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('admin.warga.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'unique:warga,nik'],
            'nama' => ['required', 'string', 'max:100'],
            'no_kk' => ['nullable', 'digits:16'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'status' => [
                'required',
                Rule::in(['aktif', 'pindah', 'meninggal']),
            ],
            'status_keluarga' => [
                'required',
                Rule::in([
                    'Kepala Keluarga',
                    'Istri / Suami',
                    'Anak',
                    'Orang Tua',
                    'Wali',
                    'Anggota Keluarga Lainnya',
                ]),
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama warga wajib diisi.',
            'no_kk.digits' => 'Nomor KK harus terdiri dari 16 angka.',
            'alamat.required' => 'Alamat wajib diisi.',
            'status_keluarga.required' =>
                'Status dalam keluarga wajib dipilih.',
            'status_keluarga.in' =>
                'Pilihan status dalam keluarga tidak valid.',
        ]);

        Warga::create($validated);

        return redirect()
            ->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('admin.warga.edit', compact('warga'));
    }

    
    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'digits:16',
                Rule::unique('warga', 'nik')->ignore($warga->id),
            ],
            'nama' => ['required', 'string', 'max:100'],
            'no_kk' => ['nullable', 'digits:16'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'status' => [
                'required',
                Rule::in(['aktif', 'pindah', 'meninggal']),
            ],
            'status_keluarga' => [
                'required',
                Rule::in([
                    'Kepala Keluarga',
                    'Istri / Suami',
                    'Anak',
                    'Orang Tua',
                    'Wali',
                    'Anggota Keluarga Lainnya',
                ]),
            ],
        ], [
            'status_keluarga.required' =>
                'Status dalam keluarga wajib dipilih.',
            'status_keluarga.in' =>
                'Pilihan status dalam keluarga tidak valid.',
        ]);

        $warga->update($validated);

        return redirect()
            ->route('admin.warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }


    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()
            ->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
