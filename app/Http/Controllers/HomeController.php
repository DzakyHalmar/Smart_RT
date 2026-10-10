<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_warga' => 420,
            'total_kk' => 125,
            'persentase_iuran' => 92,
            'saldo_kas' => 18450000,
        ];

        $pengurus = [
            [
                'jabatan' => 'Ketua RT',
                'nama' => 'Ridi Santoso',
                'inisial' => 'RS',
            ],
            [
                'jabatan' => 'Sekretaris',
                'nama' => 'Siti Rahmawati',
                'inisial' => 'SR',
            ],
            [
                'jabatan' => 'Bendahara',
                'nama' => 'Agus Setiawan',
                'inisial' => 'AS',
            ],
        ];

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
            'pemasukan' => 7850000,
            'pengeluaran' => 5240000,
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
        return view('public.pengurus');
    }

    public function pengumuman(): View
    {
        return view('public.pengumuman');
    }

    public function keuangan(): View
    {
        return view('public.keuangan');
    }
}

