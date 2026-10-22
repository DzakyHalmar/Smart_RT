
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengumuman - Smart RT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f6;
            margin: 0;
            padding: 30px;
            color: #263238;
        }

        .container {
            max-width: 750px;
            margin: 20px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,.08);
        }

        h2 { margin-top: 0; color: #176b55; }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccd5d2;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea { min-height: 150px; resize: vertical; }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border: 0;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
        }

        .save { background: #176b55; color: white; }
        .back { background: #e5eae8; color: #263238; }
        .error { color: #c62828; font-size: 13px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Pengumuman</h2>
        <p>Isi informasi yang ingin disampaikan kepada warga.</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf

            <label for="judul">Judul Pengumuman</label>
            <input type="text" id="judul" name="judul"
                   value="{{ old('judul') }}" required>

            <label for="isi">Isi Pengumuman</label>
            <textarea id="isi" name="isi" required>{{ old('isi') }}</textarea>

            <label for="tanggal">Tanggal Pengumuman</label>
            <input type="date" id="tanggal" name="tanggal"
                   value="{{ old('tanggal', date('Y-m-d')) }}" required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="draft">Draft (belum ditampilkan)</option>
                <option value="published">Published (ditampilkan)</option>
            </select>

            <button type="submit" class="btn save">Simpan Pengumuman</button>
            <a href="{{ route('admin.pengumuman.index') }}" class="btn back">
                Kembali
            </a>
        </form>
    </div>
</body>
</html>
