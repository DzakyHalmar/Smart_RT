
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="hero container">
    <div class="hero-copy">
        <span class="eyebrow"><i class="bi bi-stars"></i> Layanan Digital Warga</span>
        <h1>Bersama Membangun<br>Lingkungan yang Lebih Baik.</h1>
        <p>
            Platform layanan informasi dan administrasi warga digital
            yang transparan, mudah, dan terpercaya.
        </p>

        <div class="hero-actions">
            <a href="#" class="btn btn-primary">
                <i class="bi bi-people-fill"></i> Masuk ke Portal Warga
            </a>
            <a href="{{ route('keuangan') }}" class="btn btn-outline">
                <i class="bi bi-bar-chart-line-fill"></i>
                Lihat Transparansi Keuangan
            </a>
        </div>
    </div>

    <div class="hero-image">
        <img
            src="https://images.unsplash.com/photo-1449158743715-0a90ebb6d2d8?auto=format&fit=crop&w=1200&q=85"
            alt="Jalan lingkungan perumahan yang asri">
        <div class="image-caption">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Lingkungan nyaman, warga saling peduli</span>
        </div>
    </div>
</section>

<section class="container stats-grid">
    <article class="stat-card">
        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
        <div>
            <h2>{{ number_format($stats['total_warga'], 0, ',', '.') }}</h2>
            <p>Total Warga</p>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><i class="bi bi-house-fill"></i></div>
        <div>
            <h2>{{ number_format($stats['total_kk'], 0, ',', '.') }}</h2>
            <p>Kepala Keluarga</p>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><i class="bi bi-pie-chart-fill"></i></div>
        <div>
            <h2>{{ $stats['persentase_iuran'] }}%</h2>
            <p>Pembayaran Iuran</p>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><span class="rupiah">Rp</span></div>
        <div>
            <h2 class="stat-currency">Rp{{ number_format($stats['saldo_kas'], 0, ',', '.') }}</h2>
            <p>Total Kas RT</p>
        </div>
    </article>
</section>

<section class="container dashboard-grid">
    <article class="panel">
        <div class="panel-heading">
            <div>
                <span class="section-kicker">KENALI LINGKUNGAN</span>
                <h3>Struktur Pengurus RT 005</h3>
            </div>
            <i class="bi bi-people heading-icon"></i>
        </div>

        <div class="official-list">
            @foreach ($pengurus as $orang)
                <div class="official">
                    <div class="avatar">{{ $orang['inisial'] }}</div>
                    <div>
                        <span class="official-role">{{ $orang['jabatan'] }}</span>
                        <strong>{{ $orang['nama'] }}</strong>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('pengurus') }}" class="panel-link">
            Lihat semua pengurus <i class="bi bi-arrow-right"></i>
        </a>
    </article>

    <article class="panel">
        <div class="panel-heading">
            <div>
                <span class="section-kicker">INFO LINGKUNGAN</span>
                <h3>Pengumuman Terbaru</h3>
            </div>
            <i class="bi bi-megaphone heading-icon"></i>
        </div>

        <div class="announcement-list">
            @foreach ($pengumuman as $item)
                <div class="announcement">
                    <div class="announcement-icon">
                        <i class="bi {{ $item['ikon'] }}"></i>
                    </div>
                    <div class="announcement-copy">
                        <strong>{{ $item['judul'] }}</strong>
                        <span>{{ $item['tanggal'] }}</span>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            @endforeach
        </div>

        <a href="{{ route('pengumuman') }}" class="panel-link">
            Lihat semua pengumuman <i class="bi bi-arrow-right"></i>
        </a>
    </article>

    <article class="panel">
        <div class="panel-heading">
            <div>
                <span class="section-kicker">TERBUKA DAN TRANSPARAN</span>
                <h3>Ringkasan Keuangan</h3>
            </div>
            <span class="period-label">Oktober 2026</span>
        </div>

        <div class="finance-item income">
            <div>
                <span>Pemasukan</span>
                <strong>Rp{{ number_format($keuangan['pemasukan'], 0, ',', '.') }}</strong>
            </div>
            <i class="bi bi-arrow-down-circle-fill"></i>
        </div>

        <div class="finance-item expense">
            <div>
                <span>Pengeluaran</span>
                <strong>Rp{{ number_format($keuangan['pengeluaran'], 0, ',', '.') }}</strong>
            </div>
            <i class="bi bi-arrow-up-circle-fill"></i>
        </div>

        <div class="finance-balance">
            <span>Selisih pemasukan dan pengeluaran</span>
            <strong>Rp{{ number_format($keuangan['pemasukan'] - $keuangan['pengeluaran'], 0, ',', '.') }}</strong>
        </div>

        <a href="{{ route('keuangan') }}" class="panel-link">
            Lihat laporan keuangan <i class="bi bi-arrow-right"></i>
        </a>
    </article>

    <article class="panel digital-panel">
        <div class="panel-heading">
            <div>
                <span class="section-kicker">LEBIH MUDAH</span>
                <h3>Layanan Digital untuk Warga</h3>
            </div>
        </div>

        <div class="digital-illustration">
            <i class="bi bi-phone-fill"></i>
            <div class="mini-app-icons">
                <i class="bi bi-person-fill"></i>
                <i class="bi bi-receipt"></i>
                <i class="bi bi-megaphone-fill"></i>
                <i class="bi bi-wallet2"></i>
            </div>
        </div>

        <p>Akses layanan administrasi, informasi, dan transparansi keuangan kapan saja dan di mana saja.</p>

        <a href="#" class="btn btn-primary btn-full">
            Mulai Sekarang <i class="bi bi-arrow-right"></i>
        </a>
    </article>
</section>
@endsection
