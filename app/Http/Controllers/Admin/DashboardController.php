<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Iuran;

class DashboardController extends Controller
{
    private const NOMINAL_BULANAN = 25000;

    public function index()
    {
        // Total seluruh warga yang terdaftar.
        $totalWarga = Warga::count();

        // Gunakan tahun berjalan untuk ringkasan kartu iuran.
        $tahun = now()->year;

        // Jumlah pembayaran bulanan yang sudah tercatat pada tahun ini.
        $jumlahIuran = Iuran::where('tahun', $tahun)
            ->whereNotNull('bulan')
            ->where('jenis_iuran', 'Iuran Bulanan')
            ->count();

        // Total nominal pembayaran bulanan yang sudah lunas.
        $totalLunas = Iuran::where('tahun', $tahun)
            ->whereNotNull('bulan')
            ->where('jenis_iuran', 'Iuran Bulanan')
            ->where('status', 'lunas')
            ->count() * self::NOMINAL_BULANAN;

        // Hitung tagihan yang belum lunas untuk setiap KK aktif.
        $jumlahKK = Warga::where('status_keluarga', 'Kepala Keluarga')
            ->where('status', 'aktif')
            ->whereNotNull('no_kk')
            ->where('no_kk', '!=', '')
            ->distinct()
            ->count('no_kk');

        $totalTagihan = $jumlahKK * 12 * self::NOMINAL_BULANAN;

        $totalBelumBayar = max(0, $totalTagihan - $totalLunas);

        return view('admin.dashboard', compact(
            'totalWarga',
            'jumlahIuran',
            'totalLunas',
            'totalBelumBayar'
        ));
    }
}
