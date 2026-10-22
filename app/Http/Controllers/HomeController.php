<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Iuran;
use App\Models\Pengeluaran;
use App\Models\Pengurus;
use App\Models\Pengumuman;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Mengambil tahun dan bulan saat ini secara otomatis.
        $tahun = now()->year;
        $bulan = now()->month;

        // Menghitung total warga.
        $totalWarga = Warga::count();

        // Menghitung total KK yang terdaftar.
        $totalKK = Warga::query()
            ->whereNotNull('no_kk')
            ->where('no_kk', '<>', '')
            ->distinct()
            ->count('no_kk');

        // Mengambil nomor KK aktif dengan status Kepala Keluarga.
        $nomorKKAktif = Warga::query()
            ->where('status', 'aktif')
            ->where('status_keluarga', 'Kepala Keluarga')
            ->whereNotNull('no_kk')
            ->where('no_kk', '<>', '')
            ->distinct()
            ->pluck('no_kk');

        $jumlahKKAktif = $nomorKKAktif->count();

        // Menghitung KK yang sudah lunas pada bulan dan tahun berjalan.
        $jumlahKKLunas = Iuran::query()
            ->join('warga', 'iuran.warga_id', '=', 'warga.id')
            ->where('iuran.tahun', $tahun)
            ->where('iuran.bulan', $bulan)
            ->where('iuran.jenis_iuran', 'Iuran Bulanan')
            ->where('iuran.status', 'lunas')
            ->where('warga.status', 'aktif')
            ->whereIn('warga.no_kk', $nomorKKAktif)
            ->distinct()
            ->count('warga.no_kk');

        // Persentase pembayaran iuran bulan berjalan.
        $persentaseIuran = $jumlahKKAktif > 0
            ? (int) round(
                ($jumlahKKLunas / $jumlahKKAktif) * 100
            )
            : 0;

        // Total pemasukan dari seluruh transaksi yang sudah lunas.
        // Perhitungan dipertahankan sesuai halaman Transparansi Keuangan.
        $pemasukan = Iuran::query()
            ->where('status', 'lunas')
            ->sum('nominal');

        // Pemasukan khusus iuran bulanan yang sudah lunas.
        $pemasukanIuranBulanan = Iuran::query()
            ->where('jenis_iuran', 'Iuran Bulanan')
            ->whereNotNull('bulan')
            ->whereNotNull('tahun')
            ->where('status', 'lunas')
            ->sum('nominal');

        // Total seluruh pengeluaran yang tercatat.
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // Saldo kas mengikuti perhitungan yang sudah ada.
        $saldoKas = $pemasukan;

        // Statistik yang ditampilkan pada halaman beranda.
        $stats = [
            'total_warga' => $totalWarga,
            'total_kk' => $jumlahKKAktif,
            'persentase_iuran' => $persentaseIuran,
            'saldo_kas' => $saldoKas,
        ];

        // Mengurutkan pengurus RT berdasarkan jabatan.
        $pengurus = Pengurus::orderByRaw("
            CASE
                WHEN jabatan = 'Ketua RT' THEN 1
                WHEN jabatan = 'Wakil Ketua RT' THEN 2
                WHEN jabatan = 'Sekretaris' THEN 3
                WHEN jabatan = 'Bendahara' THEN 4
                ELSE 5
            END
        ")->get()->map(function ($orang) {
            $orang->inisial = collect(
                explode(' ', trim($orang->nama))
            )
                ->filter()
                ->take(2)
                ->map(fn ($kata) => strtoupper(
                    substr($kata, 0, 1)
                ))
                ->implode('');

            return $orang;
        });

        // Mengambil maksimal tiga pengumuman yang sudah dipublikasikan.
        $pengumuman = Pengumuman::where('status', 'published')
            ->orderByDesc('tanggal')
            ->take(3)
            ->get();

        // Data keuangan untuk halaman beranda.
        $keuangan = [
            'pemasukan' => $pemasukanIuranBulanan,
            'pengeluaran' => $totalPengeluaran,
        ];

        return view('public.home', compact(
            'stats',
            'pengurus',
            'pengumuman',
            'keuangan'
        ));
    }

    public function profil(): View
    {
        return view('public.profil');
    }

    public function pengurus(): View
    {
        $pengurus = Pengurus::orderByRaw("
            CASE
                WHEN jabatan = 'Ketua RT' THEN 1
                WHEN jabatan = 'Wakil Ketua RT' THEN 2
                WHEN jabatan = 'Sekretaris' THEN 3
                WHEN jabatan = 'Bendahara' THEN 4
                ELSE 5
            END
        ")->get();

        return view('public.pengurus', compact('pengurus'));
    }

    public function pengumuman(): View
    {
        $pengumuman = Pengumuman::where('status', 'published')
            ->orderByDesc('tanggal')
            ->get();

        return view('public.pengumuman', compact('pengumuman'));
    }

    public function keuangan(): View
    {
        // Seluruh transaksi pemasukan yang berstatus lunas.
        // Termasuk iuran bulanan, sumbangan, dan pemasukan lainnya.
        $pemasukan = Iuran::query()
            ->where('status', 'lunas')
            ->sum('nominal');

        // Seluruh pengeluaran yang tercatat.
        $pengeluaran = Pengeluaran::sum('nominal');

        // Mempertahankan perhitungan saldo seperti kode sebelumnya.
        $saldoKas = $pemasukan;

        return view('public.keuangan', compact(
            'pemasukan',
            'pengeluaran',
            'saldoKas'
        ));
    }
}