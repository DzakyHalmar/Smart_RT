
@extends('layouts.app')

@section('content')


<style>
    /* ========================================
       1. VARIABEL DAN DASAR PROFIL
    ======================================== */
    .profil-rt {
        --profil-green: #176b4d;
        --profil-dark: #123c2d;
        --profil-light: #edf7f1;

        color: #26382f;
        padding-bottom: 60px;
    }

    .profil-rt .container {
        max-width: 1140px;
    }

    /* ========================================
       2. HERO PROFIL
    ======================================== */
    .profil-hero {
        position: relative;
        overflow: hidden;
        padding: 76px 48px;
        margin: 32px 0 36px;
        border-radius: 28px;
        background: linear-gradient(
            125deg,
            #123c2d,
            #176b4d 65%,
            #358566
        );
        color: white;
    }

    .profil-hero::after {
        content: "";
        position: absolute;
        top: -100px;
        right: -70px;
        width: 290px;
        height: 290px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 50%;
        box-shadow:
            0 0 0 35px rgba(255, 255, 255, .035),
            0 0 0 70px rgba(255, 255, 255, .025);
        pointer-events: none;
    }

    .profil-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 15px;
        margin-bottom: 22px;
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 30px;
        background: rgba(255, 255, 255, .10);
        font-size: 13px;
    }

    .profil-hero h1 {
        max-width: 650px;
        margin-bottom: 18px;
        font-size: clamp(32px, 4vw, 48px);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -1.2px;
    }

    .profil-hero p {
        max-width: 610px;
        margin-bottom: 26px;
        color: rgba(255, 255, 255, .82);
        font-size: 16px;
        line-height: 1.8;
    }

    /* ========================================
       3. TOMBOL
    ======================================== */
    .profil-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: .25s ease;
    }

    .profil-btn-primary {
        background: white;
        color: var(--profil-dark);
    }

    .profil-btn-primary:hover {
        transform: translateY(-2px);
        background: #e7f5ec;
        color: var(--profil-dark);
    }

    .profil-btn-outline {
        border: 1px solid rgba(255, 255, 255, .45);
        color: white;
    }

    .profil-btn-outline:hover {
        background: rgba(255, 255, 255, .12);
        color: white;
    }

    /* ========================================
       4. JUDUL DAN JARAK SECTION
    ======================================== */
    .profil-section {
        margin-top: 44px;
    }

    .profil-section.mt-0 {
        margin-top: 0;
    }

    .profil-eyebrow {
        margin-bottom: 10px;
        color: var(--profil-green);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.6px;
        text-transform: uppercase;
    }

    .profil-heading {
        margin-bottom: 14px;
        color: var(--profil-dark);
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 800;
        letter-spacing: -.6px;
    }

    .profil-description {
        max-width: 740px;
        color: #718078;
        line-height: 1.85;
    }

    /* ========================================
       5. STATISTIK WARGA
    ======================================== */
    .profil-stat {
        height: 100%;
        padding: 24px;
        border: 1px solid #e5eee8;
        border-radius: 18px;
        background: white;
        transition: transform .25s, box-shadow .25s;
    }

    .profil-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 35px rgba(18, 60, 45, .07);
    }

    .profil-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 49px;
        height: 49px;
        margin-bottom: 18px;
        border-radius: 15px;
        background: var(--profil-light);
        color: var(--profil-green);
        font-size: 23px;
    }

    .profil-stat-number {
        margin-bottom: 5px;
        color: var(--profil-dark);
        font-size: 32px;
        font-weight: 800;
    }

    .profil-stat-label {
        color: #75847b;
        font-size: 14px;
    }

    /* ========================================
       6. CARD INFORMASI DAN VISI MISI
    ======================================== */
    .profil-card {
        height: 100%;
        padding: 28px;
        border: 1px solid #e5eee8;
        border-radius: 20px;
        background: white;
    }

    .profil-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        margin-bottom: 20px;
        border-radius: 16px;
        background: var(--profil-light);
        color: var(--profil-green);
        font-size: 24px;
    }

    .profil-card h3 {
        margin-bottom: 13px;
        color: var(--profil-dark);
        font-size: 21px;
        font-weight: 750;
    }

    .profil-card p {
        margin-bottom: 0;
        color: #718078;
        font-size: 14px;
        line-height: 1.9;
    }

    .profil-misi-list {
        padding: 0;
        margin: 20px 0 0;
        list-style: none;
    }

    .profil-misi-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 17px;
        color: #53645a;
        font-size: 14px;
        line-height: 1.7;
    }

    .profil-misi-list i {
        margin-top: 2px;
        color: var(--profil-green);
        font-size: 18px;
        flex-shrink: 0;
    }

    /* ========================================
       7. INFORMASI WILAYAH
    ======================================== */
    .profil-info {
        padding: 30px;
        border: 1px solid #e3eee6;
        border-radius: 22px;
        background: #f3f8f4;
    }

    .profil-info-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 18px 0;
        border-bottom: 1px solid #dfe9e1;
    }

    .profil-info-row:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .profil-info-icon {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: white;
        color: var(--profil-green);
        font-size: 19px;
    }

    .profil-info-label {
        display: block;
        margin-bottom: 5px;
        color: #7b8980;
        font-size: 12px;
    }

    .profil-info-value {
        color: var(--profil-dark);
        font-size: 15px;
        font-weight: 700;
    }

    
    /* ========================================
    GALERI KEGIATAN - EDITORIAL GRID
    ======================================== */

    .profil-rt .profil-gallery-section {
        margin-top: 44px;
        margin-bottom: 48px;
    }

    .profil-gallery-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .profil-gallery-header .profil-heading {
        margin-bottom: 0;
    }

    .profil-gallery-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #e2eee6;
        border-radius: 30px;
        background: #fff;
        color: #176b4d;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Grid tidak bergantung pada kolom Bootstrap */
    .profil-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        grid-template-rows: repeat(2, minmax(150px, 1fr));
        gap: 16px;
    }

    /* Semua foto */
    .profil-gallery-photo {
        position: relative;
        display: block;
        min-width: 0;
        min-height: 0;
        overflow: hidden;
        aspect-ratio: 4 / 3;
        border: 1px solid rgba(23, 107, 77, .08);
        border-radius: 18px;
        background: #edf3ee;
        box-shadow: 0 5px 18px rgba(18, 60, 45, .06);
        isolation: isolate;
    }

    .profil-gallery-photo img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }

    /* Foto utama di sebelah kiri */
    .profil-gallery-photo.profil-gallery-featured {
        grid-row: auto;
        aspect-ratio: 4 / 3;
    }

    /* Efek hover */
    .profil-gallery-photo:hover img {
        transform: scale(1.055);
    }

    .profil-gallery-zoom {
        position: absolute;
        right: 12px;
        bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 50%;
        background: rgba(18, 60, 45, .82);
        color: #fff;
        font-size: 16px;
        opacity: 0;
        transform: translateY(5px);
        transition: .25s ease;
    }

    .profil-gallery-photo:hover .profil-gallery-zoom {
        opacity: 1;
        transform: translateY(0);
    }

    /* Tablet */
    @media (max-width: 991px) {
        .profil-gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            grid-template-rows: auto;
            gap: 13px;
        }

        .profil-gallery-photo.profil-gallery-featured {
            grid-row: auto;
            aspect-ratio: 4 / 3;
        }

        .profil-gallery-photo {
            border-radius: 15px;
        }
    }

    /* HP */
    @media (max-width: 575px) {
        .profil-rt .profil-gallery-section {
            margin-top: 30px;
            margin-bottom: 34px;
        }

        .profil-gallery-header {
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .profil-gallery-count {
            padding: 8px 10px;
            font-size: 11px;
        }

        .profil-gallery-grid {
            gap: 10px;
        }

        .profil-gallery-photo {
            border-radius: 12px;
        }

        .profil-gallery-zoom {
            right: 7px;
            bottom: 7px;
            width: 30px;
            height: 30px;
            font-size: 13px;
            opacity: 1;
            transform: none;
        }
    }


    /* ========================================
       9. CTA / AJAKAN WARGA
    ======================================== */
    .profil-cta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 36px;
        margin-top: 44px;
        border-radius: 24px;
        background: var(--profil-dark);
        color: white;
    }

    .profil-cta h3 {
        margin-bottom: 10px;
        font-size: 25px;
        font-weight: 800;
    }

    .profil-cta p {
        margin-bottom: 0;
        color: rgba(255, 255, 255, .75);
        font-size: 14px;
        line-height: 1.8;
    }

    /* ========================================
       10. RESPONSIVE TABLET DAN HP
    ======================================== */
    @media (max-width: 991px) {
        .profil-hero {
            padding: 56px 36px;
        }

        .profil-card {
            padding: 24px;
        }
    }

    @media (max-width: 767px) {
        .profil-rt {
            padding-bottom: 35px;
        }

        .profil-hero {
            padding: 42px 24px;
            margin-top: 20px;
            border-radius: 22px;
        }

        .profil-hero h1 {
            font-size: clamp(28px, 7vw, 38px);
        }

        .profil-section {
            margin-top: 32px;
        }

        .profil-stat {
            padding: 18px;
        }

        .profil-stat-number {
            font-size: 27px;
        }

        .profil-card,
        .profil-info {
            padding: 22px;
        }

        .profil-cta {
            align-items: flex-start;
            flex-direction: column;
            padding: 26px;
            margin-top: 32px;
        }

        .profil-cta h3 {
            font-size: 22px;
        }

        .profil-btn {
            width: 100%;
        }

        .profil-galeri-card {
            border-radius: 12px;
        }
    }
</style>


<div class="profil-rt">
    <div class="container">

        {{-- HERO --}}
        <section class="profil-hero">
            <div class="position-relative" style="z-index: 1;">
                <div class="profil-label">
                    <i class="bi bi-house-heart-fill"></i>
                    Profil Lingkungan
                </div>

                <h1>
                    Mengenal Lingkungan,
                    <br>
                    Membangun Kebersamaan.
                </h1>

                <p>
                    Selamat datang di halaman Profil RT 01 / RW 01.
                    Bersama membangun lingkungan yang aman, nyaman,
                    harmonis, dan mengutamakan pelayanan serta keterbukaan
                    informasi bagi seluruh warga.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('pengurus') }}"
                       class="profil-btn profil-btn-primary">
                        <i class="bi bi-people-fill"></i>
                        Kenali Pengurus
                    </a>

                    <a href="{{ route('keluhan') }}"
                       class="profil-btn profil-btn-outline">
                        <i class="bi bi-chat-left-text"></i>
                        Sampaikan Aspirasi
                    </a>
                </div>
            </div>
        </section>

        
        {{-- GALERI KEGIATAN WARGA --}}
        <section class="profil-section profil-gallery-section">

            <div class="profil-gallery-header">
                <div>
                    <div class="profil-eyebrow">Dokumentasi Lingkungan</div>
                    <h2 class="profil-heading">Galeri Kegiatan Warga</h2>
                </div>
                <span class="profil-gallery-count">
                    <i class="bi bi-images"></i>
                </span>
            </div>

            <div class="profil-gallery-grid">
                 @forelse ($galeri as $item)
                    <div class="profil-gallery-photo">
                        <img
                            src="{{ asset('storage/' . $item->path_file) }}"
                            alt="Foto kegiatan RT"
                            loading="lazy"
                            style="width: 100%; height: 100%; object-fit: cover;"
                        >
                    </div>
                @empty
                    <p>Belum ada foto kegiatan yang ditambahkan.</p>
                @endforelse
            </div>

        </section>


        {{-- TENTANG KAMI --}}
        <section class="profil-section">
            <div class="row g-4">

                {{-- CARD TENTANG KAMI YANG SUDAH ADA --}}
                {{-- Semangat Kebersamaan --}}
                {{-- Lingkungan Asri --}}
                {{-- Pelayanan Warga --}}
                {{-- Transparansi --}}

            </div>

            {{-- KOMITMEN DIPINDAHKAN KE SINI --}}
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <h2 class="profil-heading">
                                Lingkungan yang Baik Dimulai dari Kebersamaan
                            </h2>
                            <p class="profil-description">
                                Rukun Tetangga merupakan bagian dari kehidupan
                                bermasyarakat yang berperan dalam membantu pelayanan
                                administrasi, mempererat hubungan antarwarga, serta
                                mendorong terciptanya lingkungan yang tertib dan
                                harmonis.
                            </p>
                            <p class="profil-description mb-0">
                                Melalui Smart_RT, informasi lingkungan, pengumuman,
                                keluhan warga, dan transparansi keuangan dapat
                                diakses dengan lebih mudah. Kami berharap layanan
                                digital ini dapat mendukung komunikasi yang lebih
                                terbuka antara pengurus dan warga.
                            </p>
                    <div class="profil-card">
                        <div class="profil-card-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>Lingkungan Aman</h3>
                        <p>
                            Mendorong kepedulian bersama terhadap keamanan,
                            ketertiban, dan kenyamanan lingkungan.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profil-card">
                        <div class="profil-card-icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h3>Keuangan Transparan</h3>
                        <p>
                            Mendukung keterbukaan informasi pemasukan
                            dan pengeluaran melalui halaman transparansi
                            keuangan.
                        </p>

                        <a href="{{ route('keuangan') }}"
                        class="text-success fw-semibold text-decoration-none d-inline-block mt-3">
                            Lihat transparansi
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="profil-card">
                        <div class="profil-card-icon">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>

                        <h3>Informasi Terbuka</h3>

                        <p>
                            Memudahkan warga memperoleh informasi dan
                            mengikuti pengumuman terbaru dari lingkungan.
                        </p>

                        <a href="{{ route('pengumuman') }}"
                        class="text-success fw-semibold text-decoration-none d-inline-block mt-3">
                            Lihat pengumuman
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        {{-- VISI DAN MISI --}}
        <section class="profil-section">
            <div class="text-center mb-4">
                <div class="profil-eyebrow">Arah dan Tujuan</div>

                <h2 class="profil-heading">
                    Visi dan Misi RT
                </h2>

                <p class="profil-description mx-auto">
                    Menjadi pedoman bersama dalam membangun lingkungan
                    yang lebih baik dan meningkatkan kualitas pelayanan
                    kepada warga.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="profil-card">
                        <div class="profil-card-icon">
                            <i class="bi bi-eye-fill"></i>
                        </div>

                        <h3>Visi</h3>

                        <p>
                            Mewujudkan lingkungan RT yang aman, nyaman,
                            harmonis, peduli, dan transparan melalui
                            pelayanan yang baik serta partisipasi aktif
                            seluruh warga.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="profil-card">
                        <div class="profil-card-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>

                        <h3>Misi</h3>

                        <ul class="profil-misi-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Meningkatkan kualitas pelayanan
                                    administrasi bagi warga.
                                </span>
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Menumbuhkan semangat gotong royong
                                    dan kepedulian sosial.
                                </span>
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Mendorong transparansi informasi
                                    dan keuangan lingkungan.
                                </span>
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Menyediakan sarana aspirasi dan
                                    komunikasi bagi warga.
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFORMASI WILAYAH --}}
        <section class="profil-section">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="profil-eyebrow">Identitas Lingkungan</div>

                    <h2 class="profil-heading">
                        Informasi Wilayah
                    </h2>

                    <p class="profil-description">
                        Informasi dasar lingkungan untuk membantu warga
                        mengenali wilayah dan mengetahui saluran pelayanan
                        yang tersedia.
                    </p>
                </div>

                <div class="col-lg-7">
                    <div class="profil-info">
                        <div class="profil-info-row">
                            <div class="profil-info-icon">
                                <i class="bi bi-house-door-fill"></i>
                            </div>

                            <div>
                                <span class="profil-info-label">
                                    Rukun Tetangga
                                </span>
                                <div class="profil-info-value">
                                    RT 01
                                </div>
                            </div>
                        </div>

                        <div class="profil-info-row">
                            <div class="profil-info-icon">
                                <i class="bi bi-diagram-3-fill"></i>
                            </div>

                            <div>
                                <span class="profil-info-label">
                                    Rukun Warga
                                </span>
                                <div class="profil-info-value">
                                    RW 012
                                </div>
                            </div>
                        </div>

                        <div class="profil-info-row">
                            <div class="profil-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>

                            <div>
                                <span class="profil-info-label">
                                    Kelurahan
                                </span>
                                <div class="profil-info-value">
                                    Kby. Lama Sel.
                                </div>
                            </div>
                        </div>

                        <div class="profil-info-row">
                            <div class="profil-info-icon">
                                <i class="bi bi-map-fill"></i>
                            </div>

                            <div>
                                <span class="profil-info-label">
                                    Kecamatan dan Kota
                                </span>
                                <div class="profil-info-value">
                                    Kec. Kebayoran Lama, Kota Jakarta Selatan.
                                </div>
                            </div>
                        </div>

                        <div class="profil-info-row">
                            <div class="profil-info-icon">
                                <i class="bi bi-map-fill"></i>
                            </div>

                            <div>
                                <span class="profil-info-label">
                                    Provinsi dan Negara
                                </span>
                                <div class="profil-info-value">
                                    Provinsi DKI Jakarta, Indonesia.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="profil-cta">
            <div>
                <h3>Mari Berpartisipasi Membangun Lingkungan</h3>

                <p>
                    Setiap masukan dan kepedulian warga berarti
                    bagi terciptanya lingkungan yang lebih baik.
                </p>
            </div>

            <a href="{{ route('keluhan') }}"
               class="profil-btn profil-btn-primary flex-shrink-0">
                <i class="bi bi-chat-dots-fill"></i>
                Sampaikan Aspirasi
            </a>
        </section>

    </div>
</div>

@endsection
