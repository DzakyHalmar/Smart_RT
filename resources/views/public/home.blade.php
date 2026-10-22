
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
            <a href="{{ route('keluhan') }}" class="btn btn-primary">
                <i class="bi bi-chat-left-text-fill"></i>
                Ajukan Keluhan
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
                <div class="avatar">{{ $orang->inisial }}</div>
                <div>
                    <span class="official-role">{{ $orang->jabatan }}</span>
                    <strong>{{ $orang->nama }}</strong>
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
        @forelse ($pengumuman as $item)
            <div class="announcement">
                <div class="announcement-icon">
                    @if ($loop->index == 0)
                        <i class="bi bi-megaphone"></i>
                    @elseif ($loop->index == 1)
                        <i class="bi bi-calendar-check"></i>
                    @else
                        <i class="bi bi-people"></i>
                    @endif
                </div>

                <div class="announcement-copy">
                    <strong>{{ $item->judul }}</strong>
                    <span>
                        {{ $item->tanggal->translatedFormat('d F Y') }}
                    </span>
                </div>

                <i class="bi bi-chevron-right"></i>
            </div>
        @empty
            <p>Belum ada pengumuman terbaru.</p>
        @endforelse
    </div>


        <a href="{{ route('pengumuman') }}" class="panel-link">
            Lihat semua pengumuman <i class="bi bi-arrow-right"></i>
        </a>
    </article>

    <article class="panel">
        <div class="panel-heading">
            <div>
                <span class="section-kicker">TERBUKA DAN TRANSPARAN</span>
                <h3>Ringkasan Iuran Bulanan</h3>
            </div>
            <span class="period-label">{{ now()->translatedFormat('F Y') }}</span>
        </div>

        <div class="finance-item income">
            <div>
                <span>Pemasukan</span>
                <strong>Rp{{ number_format($keuangan['pemasukan'], 0, ',', '.') }}</strong>
            </div>
            <i class="bi bi-arrow-down-circle-fill"></i>
        </div>

        <a href="{{ route('keuangan') }}" class="panel-link">
            Lihat laporan Lengkap keuangan <i class="bi bi-arrow-right"></i>
        </a>
    </article>

    <article class="panel digital-panel">
        <div class="panel-heading">
            <div>
                <span class="section-kicker">TEMUKAN LOKASI KAMI</span>
                <h3>Lokasi RT Kami</h3>
            </div>
            <i class="bi bi-geo-alt-fill heading-icon"></i>
        </div>

        <div class="rt-map">
            <iframe
                src="https://maps.google.com/maps?q=Jl.%20Jatayu%201%2C%20RT%20001%2C%20Kebayoran%20Lama%20Selatan%2C%20Kebayoran%20Lama%2C%20Jakarta%20Selatan%2012240&output=embed"
                width="100%"
                height="250"
                style="border:0;"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                title="Peta lokasi RT">
            </iframe>
        </div>

        <p class="map-address">
            <i class="bi bi-geo-alt-fill"></i>
            Jl. Jatayu 1, RT 001/RW 012, Kebayoran Lama Selatan,
            Jakarta Selatan 12240
        </p>

        <a
            href="https://www.google.com/maps/search/?api=1&query=Jl.%20Jatayu%201%2C%20RT%20001%2C%20Kebayoran%20Lama%20Selatan%2C%20Kebayoran%20Lama%2C%20Jakarta%20Selatan%2012240"
            target="_blank"
            rel="noopener noreferrer"
            class="btn btn-primary btn-full">
            Buka Google Maps
            <i class="bi bi-arrow-up-right"></i>
        </a>
    </article>
</section>
@endsection
