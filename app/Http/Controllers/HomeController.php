<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Iuran;
use App\Models\Pengeluaran;
use App\Models\Pengurus;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $tahun = now()->year;

        // Total warga terdaftar.
        $totalWarga = Warga::count();

        // Nomor KK unik yang valid.
        $totalKK = Warga::query()
            ->whereNotNull('no_kk')
            ->where('no_kk', '<>', '')
            ->distinct()
            ->count('no_kk');

        // KK aktif yang memiliki warga berstatus Kepala Keluarga.
        $nomorKKAktif = Warga::query()
            ->where('status', 'aktif')
            ->where('status_keluarga', 'Kepala Keluarga')
            ->whereNotNull('no_kk')
            ->where('no_kk', '<>', '')
            ->distinct()
            ->pluck('no_kk');

        $jumlahKKAktif = $nomorKKAktif->count();

        // Jumlah KK aktif yang sudah membayar iuran bulanan
        // pada tahun terpilih. Satu KK dihitung satu kali.
        $jumlahKKLunas = Iuran::query()
            ->join('warga', 'iuran.warga_id', '=', 'warga.id')
            ->where('iuran.tahun', $tahun)
            ->whereNotNull('iuran.bulan')
            ->where('iuran.jenis_iuran', 'Iuran Bulanan')
            ->where('iuran.status', 'lunas')
            ->where('warga.status', 'aktif')
            ->whereIn('warga.no_kk', $nomorKKAktif)
            ->distinct()
            ->count('warga.no_kk');

        // Total tagihan tahunan: 12 bulan per KK aktif.
        $totalTagihanTahunan = $jumlahKKAktif * 12;

        // Persentase berdasarkan jumlah tagihan bulanan
        // yang lunas dibandingkan seluruh tagihan setahun.
        $persentaseIuran = $totalTagihanTahunan > 0
            ? (int) round(
                ($jumlahKKLunas / $totalTagihanTahunan) * 100
            )
            : 0;

        // Pemasukan aktual dari semua transaksi iuran lunas,
        // termasuk sumbangan dan transaksi lama.
        $pemasukan = Iuran::query()
            ->where('jenis_iuran', 'Iuran Bulanan')
            ->whereNotNull('bulan')
            ->whereNotNull('tahun')
            ->where('status', 'lunas')
            ->sum('nominal');

        // Total seluruh pengeluaran yang tercatat.
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // Saldo kas aktual.
        $saldoKas = $pemasukan - $totalPengeluaran;

        $stats = [
            'total_warga' => $totalWarga,
            'total_kk' => $jumlahKKAktif,
            'persentase_iuran' => $persentaseIuran,
            'saldo_kas' => $saldoKas,
        ];

        // Urutan pengurus RT.
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

        // Pengumuman sementara masih menggunakan data statis.
        $pengumuman = [
            [
                'judul' => 'Kerja Bakti Lingkungan',
                'tanggal' => '12 Oktober 2026',
                'ikon' => 'bi-megaphone',
            ],
            [
                'judul' => 'Pembayaran Iuran Bulanan',
                'tanggal' => 'Batas pembayaran 31 Oktober 2026',
                'ikon' => 'bi-calendar-check',
            ],
            [
                'judul' => 'Rapat Warga',
                'tanggal' => 'Bulan November 2026',
                'ikon' => 'bi-people',
            ],
        ];

        $keuangan = [
            'pemasukan' => $pemasukan,
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
        return view('public.pengumuman');
    }

    public function keuangan(): View
    {
        // Pemasukan dari kartu iuran bulanan yang sudah lunas.
        $pemasukan = Iuran::query()
            ->where('jenis_iuran', 'Iuran Bulanan')
            ->whereNotNull('bulan')
            ->whereNotNull('tahun')
            ->where('status', 'lunas')
            ->sum('nominal');

        // Pengeluaran tetap dihitung dari seluruh data pengeluaran.
        $pengeluaran = Pengeluaran::sum('nominal');

        // Saldo berdasarkan pemasukan kartu iuran dikurangi pengeluaran.
        $saldoKas = $pemasukan - $pengeluaran;

        return view('public.keuangan', compact(
            'pemasukan',
            'pengeluaran',
            'saldoKas'
        ));
    }

}
