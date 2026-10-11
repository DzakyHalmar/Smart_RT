
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
            background: #f4f7f5;
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
        }

        header h1 {
            font-size: 22px;
        }

        header p {
            font-size: 13px;
            margin-top: 5px;
            opacity: 0.85;
        }

        .logout {
            background: white;
            color: #166534;
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
        }

        main {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #64748b;
            line-height: 1.6;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
        }

        .card .icon {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 17px;
            margin-bottom: 9px;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .status {
            display: inline-block;
            margin-top: 20px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: bold;
        }

        @media (max-width: 750px) {
            .cards {
                grid-template-columns: 1fr;
            }

            header h1 {
                font-size: 18px;
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

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
    </header>

    <main>
        <section class="welcome">
            <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
            <p>
                Kamu berhasil masuk ke dashboard admin Smart RT.
                Kelola informasi dan transparansi keuangan lingkungan
                dari panel ini.
            </p>
            <span class="status">● Login berhasil</span>
        </section>

        <section class="cards">
            <article class="card">
                <div class="icon">👥</div>
                <h3>Data Warga</h3>
                <p>Pengelolaan data warga dan kepala keluarga.</p>

                <a href="{{ route('admin.warga.index') }}"
                    style="display:inline-block;
                            margin-top:15px;
                            color:#15803d;
                            text-decoration:none;
                            font-weight:bold">
                        Kelola Data Warga →
                </a>
            </article>

            <article class="card">
                <div class="icon">💰</div>
                <h3>Data Iuran</h3>
                <p>Pencatatan pembayaran iuran warga, termasuk pembayaran tunai.</p>
            </article>

            <article class="card">
                <div class="icon">📊</div>
                <h3>Keuangan RT</h3>
                <p>Pencatatan pemasukan, pengeluaran, dan saldo kas RT.</p>
            </article>
        </section>
    </main>

</body>
</html>
