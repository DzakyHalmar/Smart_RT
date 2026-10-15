<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Iuran;
use App\Models\Pengeluaran;
use Illuminate\View\View;
use App\Models\Pengurus;

class HomeController extends Controller
{
    public function index(): View
    {
        // Statistik warga
        $totalWarga = Warga::count();

        // Jumlah kepala keluarga berdasarkan nomor KK unik
        $totalKK = Warga::distinct('no_kk')->count('no_kk');

        // Statistik iuran
        $jumlahIuran = Iuran::count();

        $jumlahLunas = Iuran::where('status', 'lunas')->count();

        $persentaseIuran = $jumlahIuran > 0
            ? round(($jumlahLunas / $jumlahIuran) * 100)
            : 0;

        // Pemasukan hanya dari iuran yang sudah lunas
        $pemasukan = Iuran::where('status', 'lunas')->sum('nominal');

        // Total pengeluaran yang tercatat
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // Saldo kas
        $saldoKas = $pemasukan - $totalPengeluaran;

        $stats = [
            'total_warga' => $totalWarga,
            'total_kk' => $totalKK,
            'persentase_iuran' => $persentaseIuran,
            'saldo_kas' => $saldoKas,
        ];

        // Data pengurus sementara
        $pengurus = Pengurus::orderByRaw("
            CASE
                WHEN jabatan = 'Ketua RT' THEN 1
                WHEN jabatan = 'Wakil Ketua RT' THEN 2
                WHEN jabatan = 'Sekretaris' THEN 3
                WHEN jabatan = 'Bendahara' THEN 4
                ELSE 5
            END
        ")->get()->map(function ($orang) {
            $orang->inisial = collect(explode(' ', trim($orang->nama)))
                ->filter()
                ->take(2)
                ->map(fn ($kata) => strtoupper(substr($kata, 0, 1)))
                ->implode('');

            return $orang;
        });

        // Data pengumuman sementara
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

    public function pengurus()
    {
        $pengurus = \App\Models\Pengurus::orderByRaw("
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
        $pemasukan = Iuran::where('status', 'lunas')
        ->sum('nominal');

        $pengeluaran = Pengeluaran::sum('nominal');

        $saldoKas = $pemasukan - $pengeluaran;

        return view('public.keuangan', compact(
            'pemasukan',
            'pengeluaran',
            'saldoKas'
        ));
    }
}