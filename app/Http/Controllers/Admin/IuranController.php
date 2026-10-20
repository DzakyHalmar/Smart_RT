<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IuranController extends Controller
{
    private const NOMINAL_BULANAN = 25000;

    private function namaBulan(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    // Daftar warga beserta progres pembayaran tahun terpilih.
    
    public function index(Request $request)
    {
        $tahun = (int) $request->query('tahun', now()->year);

        abort_if($tahun < 2000 || $tahun > 2100, 422);

        $warga = Warga::query()
            ->where('status_keluarga', 'Kepala Keluarga')
            ->whereNotNull('no_kk')
            ->where('no_kk', '<>', '')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        // Hitung pembayaran berdasarkan nomor KK.
        $nomorKK = $warga->getCollection()
            ->pluck('no_kk')
            ->unique()
            ->values();

        $progres = Iuran::query()
            ->selectRaw(
                'no_kk, SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS bulan_lunas',
                ['lunas']
            )
            ->where('tahun', $tahun)
            ->whereNotNull('bulan')
            ->whereIn('no_kk', $nomorKK)
            ->groupBy('no_kk')
            ->get()
            ->keyBy('no_kk');

        foreach ($warga as $kepalaKeluarga) {
            $kepalaKeluarga->bulan_lunas = (int) (
                $progres[$kepalaKeluarga->no_kk]->bulan_lunas ?? 0
            );
        }

        return view('admin.iuran.index', compact('warga', 'tahun'));
    }


    // Menampilkan kartu iuran satu warga.    
    public function kartu(Warga $warga, Request $request)
    {
        abort_if(
            $warga->status_keluarga !== 'Kepala Keluarga'
            || empty($warga->no_kk),
            404
        );

        $tahun = (int) $request->query('tahun', now()->year);

        abort_if($tahun < 2000 || $tahun > 2100, 422);

        $transaksi = Iuran::where('no_kk', $warga->no_kk)
            ->where('tahun', $tahun)
            ->whereNotNull('bulan')
            ->get()
            ->keyBy('bulan');

        $bulanList = $this->namaBulan();

        $totalLunas = $transaksi
            ->where('status', 'lunas')
            ->count();

        $totalDibayar = $totalLunas * self::NOMINAL_BULANAN;
        $totalTagihan = 12 * self::NOMINAL_BULANAN;
        $sisaTagihan = $totalTagihan - $totalDibayar;

        return view('admin.iuran.kartu', compact(
            'warga',
            'tahun',
            'bulanList',
            'transaksi',
            'totalLunas',
            'totalDibayar',
            'totalTagihan',
            'sisaTagihan'
        ));
    }


    // Mencatat pembayaran bulan tertentu.
    public function bayar(Request $request, Warga $warga)
    {
        abort_if(
            $warga->status_keluarga !== 'Kepala Keluarga'
            || empty($warga->no_kk),
            404
        );

        $validated = $request->validate([
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'between:2000,2100'],
            'tanggal_iuran' => ['required', 'date'],
        ]);

        $bulan = (int) $validated['bulan'];
        $tahun = (int) $validated['tahun'];

        $sudahAda = Iuran::where('no_kk', $warga->no_kk)
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->exists();

        if ($sudahAda) {
            return back()->withErrors([
                'bulan' => 'Tagihan bulan ini sudah memiliki catatan. Periksa kartu iuran terlebih dahulu.',
            ]);
        }

        Iuran::create([
            'warga_id' => $warga->id,
            'no_kk' => $warga->no_kk,
            'jenis_iuran' => 'Iuran Bulanan',
            'nominal' => self::NOMINAL_BULANAN,
            'tanggal_iuran' => $validated['tanggal_iuran'],
            'status' => 'lunas',
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        return redirect()
            ->route('admin.iuran.kartu', [
                'warga' => $warga->id,
                'tahun' => $tahun,
            ])
            ->with('success', 'Pembayaran iuran keluarga berhasil dicatat.');
    }


    // Membatalkan catatan pembayaran bulanan.    
    public function batalBayar(Request $request, Warga $warga)
    {
        abort_if(
            $warga->status_keluarga !== 'Kepala Keluarga'
            || empty($warga->no_kk),
            404
        );

        $validated = $request->validate([
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'between:2000,2100'],
        ]);

        Iuran::where('no_kk', $warga->no_kk)
            ->where('tahun', $validated['tahun'])
            ->where('bulan', $validated['bulan'])
            ->where('jenis_iuran', 'Iuran Bulanan')
            ->delete();

        return redirect()
            ->route('admin.iuran.kartu', [
                'warga' => $warga->id,
                'tahun' => $validated['tahun'],
            ])
            ->with('success', 'Catatan pembayaran berhasil dibatalkan.');
    }

    // CRUD transaksi lama tetap tersedia.
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
