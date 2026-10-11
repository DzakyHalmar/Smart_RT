
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Smart RT</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, #e9f7ef, #e8f0ff);
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 36px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.09);
        }

        .logo {
            width: 66px;
            height: 66px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: #dcfce7;
            color: #15803d;
            font-size: 30px;
            font-weight: bold;
        }

        h1 {
            color: #172b24;
            font-size: 25px;
            text-align: center;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718078;
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            color: #34443b;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d9e2dc;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }

        .error {
            color: #b91c1c;
            background: #fef2f2;
            padding: 12px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #15803d;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #166534;
        }

        .back-link {
            display: block;
            margin-top: 22px;
            color: #15803d;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 26px 22px;
            }
        }
        
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-right: 50px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 20px;
            color: #64748b;
            padding: 5px;
        }

        .toggle-password:focus-visible {
            outline: 2px solid #15803d;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo">RT</div>

        <h1>Login Admin</h1>
        <p class="subtitle">
            Smart RT — Sistem Informasi dan Transparansi
            Keuangan Rukun Tetangga
        </p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Admin</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@smartrt.id"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        id="togglePassword"
                        class="toggle-password"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >
                        👁
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Masuk ke Dashboard
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            ← Kembali ke halaman utama
        </a>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            togglePassword.textContent = isHidden ? '🙈' : '🙉';

            togglePassword.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );

            togglePassword.setAttribute('aria-pressed', String(isHidden));
        });
    </script>

</body>
</html>
