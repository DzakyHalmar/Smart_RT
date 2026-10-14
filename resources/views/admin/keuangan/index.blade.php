
@extends('layouts.admin')
@section('content')
<div class="container" style="padding-top:30px;padding-bottom:40px;">
    <h1>Rekap Keuangan RT</h1>
    <p>Ringkasan iuran berdasarkan data yang tercatat di database.</p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-top:24px;">

        <div style="background:#ecfdf5;padding:24px;border-radius:12px;">
            <p>Total Seluruh Iuran</p>
            <h2>Rp {{ number_format((float)$totalIuran, 0, ',', '.') }}</h2>
        </div>

        <div style="background:#dcfce7;padding:24px;border-radius:12px;">
            <p>Total Iuran Lunas</p>
            <h2>Rp {{ number_format((float)$totalLunas, 0, ',', '.') }}</h2>
        </div>

        <div style="background:#fef3c7;padding:24px;border-radius:12px;">
            <p>Total Belum Dibayar</p>
            <h2>Rp {{ number_format((float)$totalBelumBayar, 0, ',', '.') }}</h2>
        </div>

        <div style="background:#f3f4f6;padding:24px;border-radius:12px;">
            <p>Jumlah Data Iuran</p>
            <h2>{{ $jumlahTransaksi }} data</h2>
        </div>

    </div>

    <div style="margin-top:24px;">
        <a href="{{ route('admin.dashboard') }}"
           style="display:inline-block;background:#166534;color:white;padding:12px 18px;border-radius:8px;text-decoration:none;">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
