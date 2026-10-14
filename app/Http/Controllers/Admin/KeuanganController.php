<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $totalIuran = Iuran::sum('nominal');

        $totalLunas = Iuran::where('status', 'lunas')
            ->sum('nominal');

        $totalBelumBayar = Iuran::where('status', 'belum_bayar')
            ->sum('nominal');

        $jumlahTransaksi = Iuran::count();

        return view('admin.keuangan.index', compact(
            'totalIuran',
            'totalLunas',
            'totalBelumBayar',
            'jumlahTransaksi'
        ));
    }    
}
