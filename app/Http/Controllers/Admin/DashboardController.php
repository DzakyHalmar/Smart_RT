<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Iuran;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik warga
        $totalWarga = Warga::count();

        // Statistik iuran
        $jumlahIuran = Iuran::count();

        $totalLunas = Iuran::where('status', 'lunas')
            ->sum('nominal');

        $totalBelumBayar = Iuran::where('status', 'belum_bayar')
            ->sum('nominal');

        return view('admin.dashboard', compact(
            'totalWarga',
            'jumlahIuran',
            'totalLunas',
            'totalBelumBayar'
        ));
    }
}
