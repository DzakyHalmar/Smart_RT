
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga | Smart RT</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 25px 15px;
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            color: #1f2937;
        }
        .container { max-width: 760px; margin: 0 auto; }
        .top { margin-bottom: 22px; }
        .top a { color: #15803d; text-decoration: none; font-size: 14px; }
        h1 { font-size: 26px; margin: 18px 0 8px; }
        .muted { color: #64748b; font-size: 14px; line-height: 1.6; }
        .card {
            background: white;
            padding: 28px;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,.04);
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group { margin-bottom: 20px; }
        .full { grid-column: 1 / -1; }
        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            font: inherit;
            font-size: 14px;
        }
        input:focus, textarea:focus, select:focus {
            outline: 2px solid #bbf7d0;
            border-color: #15803d;
        }
        textarea { min-height: 100px; resize: vertical; }
        .hint { display: block; margin-top: 6px; color: #64748b; font-size: 12px; }
        .error { color: #b91c1c; font-size: 12px; margin-top: 6px; }
        .alert {
            padding: 13px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 14px;
        }
        .actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 5px;
        }
        .btn {
            display: inline-block;
            padding: 12px 17px;
            border: 0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }
        .primary { background: #15803d; color: white; }
        .secondary { background: #e2e8f0; color: #334155; }
        @media(max-width: 580px) {
            .form-grid { grid-template-columns: 1fr; gap: 0; }
            .full { grid-column: auto; }
            .card { padding: 20px; }
            .actions { flex-direction: column-reverse; }
            .actions .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="top">
        <a href="{{ route('admin.warga.index') }}">← Kembali ke Data Warga</a>
        <h1>Edit Data Warga</h1>
        <p class="muted">Perbarui informasi untuk {{ $warga->nama }}.</p>
    </div>

    @if ($errors->any())
        <div class="alert">
            <b>Data belum bisa diperbarui:</b>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.warga.update', $warga) }}" method="POST" class="card">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label for="nik">NIK *</label>
                <input
                    type="text"
                    id="nik"
                    name="nik"
                    value="{{ old('nik', $warga->nik) }}"
                    inputmode="numeric"
                    pattern="[0-9]{16}"
                    minlength="16"
                    maxlength="16"
                    required
                >
                <span class="hint">NIK harus terdiri dari 16 angka.</span>
                @error('nik') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama', $warga->nama) }}"
                    maxlength="100"
                    required
                >
                @error('nama') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="no_kk">Nomor KK</label>
                <input
                    type="text"
                    id="no_kk"
                    name="no_kk"
                    value="{{ old('no_kk', $warga->no_kk) }}"
                    inputmode="numeric"
                    pattern="[0-9]{16}"
                    minlength="16"
                    maxlength="16"
                >
                @error('no_kk') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input
                    type="tel"
                    id="no_telepon"
                    name="no_telepon"
                    value="{{ old('no_telepon', $warga->no_telepon) }}"
                    maxlength="20"
                >
                @error('no_telepon') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group full">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea id="alamat" name="alamat" required>{{ old('alamat', $warga->alamat) }}</textarea>
                @error('alamat') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group full">
                <label for="status">Status Warga *</label>
                <select id="status" name="status" required>
                    <option value="aktif" {{ old('status', $warga->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="pindah" {{ old('status', $warga->status) === 'pindah' ? 'selected' : '' }}>Pindah</option>
                    <option value="meninggal" {{ old('status', $warga->status) === 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                </select>
                @error('status') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('admin.warga.index') }}" class="btn secondary">Batal</a>
            <button type="submit" class="btn primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>
