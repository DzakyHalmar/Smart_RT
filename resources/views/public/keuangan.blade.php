@extends('layouts.app')

@section('title', 'Transparansi Keuangan')

@section('content')
<section class="page-header">
    <div class="container">
        <span class="eyebrow">KEUANGAN RT</span>
        <h1>Transparansi Keuangan</h1>
        <p>
            Laporan keuangan RT yang terbuka dan dapat diketahui
            oleh seluruh warga.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="stats-grid finance-stats-grid">
            <div class="stat-card">
                <span>Total Pemasukan</span>
                <h2>Rp 7.850.000</h2>
                <p>Dana yang diterima RT</p>
            </div>

            <div class="stat-card">
                <span>Total Pengeluaran</span>
                <h2>Rp 5.240.000</h2>
                <p>Dana yang digunakan</p>
            </div>

            <div class="stat-card">
                <span>Saldo Kas</span>
                <h2>Rp 2.610.000</h2>
                <p>Sisa dana berdasarkan laporan</p>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2>Ringkasan Keuangan</h2>
                    <p>Informasi penggunaan dana RT</p>
                </div>
            </div>

            <div class="finance-row">
                <span>Pemasukan</span>
                <strong class="text-success">Rp 7.850.000</strong>
            </div>

            <div class="finance-row">
                <span>Pengeluaran</span>
                <strong>Rp 5.240.000</strong>
            </div>

            <div class="finance-row">
                <span>Saldo Akhir</span>
                <strong>Rp 2.610.000</strong>
            </div>
        </div>

        <div class="alert">
            <strong>Informasi:</strong>
            Data di atas masih berupa contoh tampilan.
            Nantinya, data akan diambil dari database dan diperbarui
            berdasarkan transaksi iuran serta pengeluaran RT.
        </div>

    </div>
</section>
@endsection