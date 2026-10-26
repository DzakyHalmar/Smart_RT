
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Smart RT</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6f4;
            color: #1f2937;
        }

        header {
            background: #166534;
            color: white;
            padding: 20px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        header h1 {
            font-size: 23px;
        }

        header p {
            font-size: 13px;
            margin-top: 5px;
            color: #dcfce7;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-home,
        .logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #166534;
            text-decoration: none;
            border: 1px solid white;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .btn-home:hover,
        .logout:hover {
            background: #dcfce7;
        }

        .header-actions form {
            margin: 0;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 36px 24px 50px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h2 {
            font-size: 27px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #64748b;
            line-height: 1.7;
            max-width: 650px;
        }

        .status {
            display: inline-block;
            margin-top: 16px;
            padding: 8px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: bold;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 16px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            background: white;
            padding: 25px;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .035);
            transition: transform .2s, box-shadow .2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(22, 101, 52, .09);
        }

        .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 13px;
            background: #dcfce7;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            flex: 1;
        }

        .card-link {
            display: inline-block;
            margin-top: 22px;
            padding: 11px 14px;
            background: #166534;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            transition: .2s;
        }

        .card-link:hover {
            background: #14532d;
        }

        @media (max-width: 850px) {
            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 580px) {
            header {
                padding: 18px;
            }

            header h1 {
                font-size: 20px;
            }

            main {
                padding: 28px 16px;
            }

            .welcome h2 {
                font-size: 23px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 22px;
            }
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .035);
        }

        .stat-card .label {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .stat-card .value {
            color: #166534;
            font-size: 25px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        @media (max-width: 850px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {
            .stats {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>

<header>
    <div>
        <h1>Smart RT</h1>
        <p>Panel Administrasi</p>
    </div>

    <div class="header-actions">
        <a href="{{ route('home') }}" class="btn-home">
            Halaman Utama
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
    </div>
</header>

<main>
    {{-- Sambutan Admin --}}
    <section class="welcome">
        <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
        <p>
            Kelola data warga, pengurus, pencatatan iuran,
            pengeluaran, dan transparansi keuangan lingkungan
            melalui dashboard administrasi Smart RT.
        </p>
        <span class="status">● Login berhasil</span>
    </section>

    {{-- Ringkasan Statistik --}}
    <h2 class="section-title">Ringkasan Data</h2>

    <section class="stats">
        <article class="stat-card">
            <p class="label">Total Warga</p>
            <div class="value">
                {{ number_format($totalWarga, 0, ',', '.') }}
            </div>
            <p class="label">Warga terdaftar</p>
        </article>

        <article class="stat-card">
            <p class="label">Jumlah Data Iuran</p>
            <div class="value">
                {{ number_format($jumlahIuran, 0, ',', '.') }}
            </div>
            <p class="label">Data iuran tercatat</p>
        </article>

        <article class="stat-card">
            <p class="label">Total Iuran Lunas</p>
            <div class="value">
                Rp {{ number_format((float) $totalLunas, 0, ',', '.') }}
            </div>
            <p class="label">Nominal berstatus lunas</p>
        </article>

        <article class="stat-card">
            <p class="label">Belum Dibayar</p>
            <div class="value">
                Rp {{ number_format((float) $totalBelumBayar, 0, ',', '.') }}
            </div>
            <p class="label">Nominal belum dibayar</p>
        </article>
    </section>

    {{-- Menu Administrasi --}}
    <h2 class="section-title">Menu Administrasi</h2>

    <section class="cards">
        {{-- Data Warga --}}
        <article class="card">
            <div class="icon">👥</div>
            <h3>Data Warga</h3>
            <p>
                Kelola informasi warga, NIK, nomor KK, alamat,
                dan status warga.
            </p>
            <a href="{{ route('admin.warga.index') }}" class="card-link">
                Kelola Data Warga →
            </a>
        </article>

        {{-- Data Pengurus --}}
        <article class="card">
            <div class="icon">👔</div>
            <h3>Data Pengurus</h3>
            <p>
                Kelola informasi ketua RT, sekretaris, bendahara,
                dan pengurus lingkungan lainnya.
            </p>
            <a href="{{ route('admin.pengurus.index') }}" class="card-link">
                Kelola Data Pengurus →
            </a>
        </article>

        {{-- Data Iuran --}}
        <article class="card">
            <div class="icon">💰</div>
            <h3>Data Iuran</h3>
            <p>
                Catat iuran warga, periksa status pembayaran,
                dan kelola data iuran yang tercatat.
            </p>
            <a href="{{ route('admin.iuran.index') }}" class="card-link">
                Kelola Data Iuran →
            </a>
        </article>

        {{-- Pengeluaran --}}
        <article class="card">
            <div class="icon">💸</div>
            <h3>Pengeluaran Kas RT</h3>
            <p>
                Catat pengeluaran operasional, kebersihan,
                keamanan, dan kegiatan warga.
            </p>
            <a href="{{ route('admin.pengeluaran.index') }}" class="card-link">
                Kelola Pengeluaran →
            </a>
        </article>

        {{-- Keuangan --}}
        <article class="card">
            <div class="icon">📊</div>
            <h3>Keuangan RT</h3>
            <p>
                Pantau total iuran, pembayaran lunas,
                pengeluaran, dan saldo kas RT.
            </p>
            <a href="{{ route('admin.keuangan') }}" class="card-link">
                Lihat Rekap Keuangan →
            </a>
        </article>

        
        {{-- Pengumuman --}}
        <article class="card">
            <div class="icon">📢</div>
            <h3>Pengumuman</h3>
            <p>
                Tambahkan, edit, dan hapus pengumuman
                untuk ditampilkan kepada warga di halaman Home.
            </p>
            <a href="{{ route('admin.pengumuman.index') }}"
               class="card-link">
                Kelola Pengumuman →
            </a>
        </article>

        
    {{-- Keluhan Warga --}}
    <article class="card">
        <div class="icon">💬</div>
        <h3>Keluhan Warga</h3>
        <p>
            Lihat laporan warga dan pantau status penanganan keluhan.
        </p>
        <a href="{{ route('admin.keluhan.index') }}" class="card-link">
            Kelola Keluhan →
        </a>
    </article>

    
        {{-- Galeri Foto --}}
        <article class="card">
            <div class="icon">📸</div>
            <h3>Galeri Foto</h3>
            <p>
                Tambahkan foto kegiatan RT, lihat foto yang sudah
                tersimpan, dan hapus foto yang tidak diperlukan.
            </p>
            <a href="{{ route('admin.galeri.index') }}"
               class="card-link">
                Kelola Galeri Foto →
            </a>
        </article>
    </section>
</main>

</body>
</html>
