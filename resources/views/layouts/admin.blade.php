<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Smart RT')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6f4;
            color: #243447;
        }

        .admin-header {
            background: #166534;
            color: white;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .admin-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .admin-header p {
            margin: 4px 0 0;
            color: #dcfce7;
        }

        .admin-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .admin-actions a,
        .admin-actions button {
            background: white;
            color: #166534;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .admin-actions a:hover,
        .admin-actions button:hover {
            background: #dcfce7;
        }

        .admin-content {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 36px 24px 48px;
            min-height: 65vh;
        }

        .admin-content h1 {
            font-size: 28px;
            font-weight: 700;
        }

        @media (max-width: 600px) {
            .admin-header {
                padding: 18px;
            }

            .admin-content {
                padding: 24px 16px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <header class="admin-header">
        <div>
            <h1>Smart RT</h1>
            <p>Panel Administrasi</p>
        </div>

        <div class="admin-actions">
            <a href="{{ route('home') }}">Halaman Utama</a>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main class="admin-content">
        @yield('content')
    </main>

</body>
</html>
