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

        {{-- Ringkasan Keuangan --}}
        <div class="stats-grid finance-stats-grid">

            <div class="stat-card">
                <span>Total Pemasukan</span>
                <h2>
                    Rp {{ number_format($pemasukan, 0, ',', '.') }}
                </h2>
                <p>Dana dari iuran yang sudah lunas</p>
            </div>

            <div class="stat-card">
                <span>Total Pengeluaran</span>
                <h2>
                    Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                </h2>
                <p>Total dana yang telah dicatat keluar</p>
            </div>

            <div class="stat-card">
                <span>Saldo Kas</span>
                <h2>
                    Rp {{ number_format($saldoKas, 0, ',', '.') }}
                </h2>
                <p>Pemasukan dikurangi pengeluaran</p>
            </div>

        </div>

        {{-- Rincian Keuangan --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2>Ringkasan Keuangan</h2>
                    <p>Informasi penggunaan dana RT berdasarkan database</p>
                </div>
            </div>

            <div class="finance-row">
                <span>Total Pemasukan</span>
                <strong class="text-success">
                    Rp {{ number_format($pemasukan, 0, ',', '.') }}
                </strong>
            </div>

            <div class="finance-row">
                <span>Total Pengeluaran</span>
                <strong>
                    Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                </strong>
            </div>

            <div class="finance-row">
                <span>Saldo Akhir</span>
                <strong class="{{ $saldoKas < 0 ? 'text-danger' : 'text-success' }}">
                    Rp {{ number_format($saldoKas, 0, ',', '.') }}
                </strong>
            </div>
        </div>

        <div class="alert">
            <strong>Informasi:</strong>
            Data keuangan ditampilkan berdasarkan transaksi iuran
            berstatus lunas dan pengeluaran yang tercatat di sistem.
        </div>

    </div>
</section>
@endsection