@extends('layouts.admin')

@section('title', 'Tambah Warga | Smart RT')

@push('styles')
<style>
        * { box-sizing: border-box; }
        .warga-form-container { max-width: 760px; margin: 0 auto; }
        .top { margin-bottom: 22px; }
        .top a { color: #15803d; text-decoration: none; font-size: 14px; }
        .warga-form-container h1 { font-size: 26px; margin: 18px 0 8px; }
        .muted { color: #64748b; font-size: 14px; line-height: 1.6; }
        .warga-form-container .card {
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
        .warga-form-container label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .warga-form-container input, .warga-form-container textarea, .warga-form-container select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            font: inherit;
            font-size: 14px;
        }
        .warga-form-container input:focus, .warga-form-container textarea:focus, .warga-form-container select:focus {
            outline: 2px solid #bbf7d0;
            border-color: #15803d;
        }
        .warga-form-container textarea { min-height: 100px; resize: vertical; }
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
        .warga-form-container .btn {
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
            .warga-form-container .card { padding: 20px; }
            .actions { flex-direction: column-reverse; }
            .actions .warga-form-container .btn { width: 100%; text-align: center; }
        }
    
        .warga-form-container { padding: 10px 0 30px; }

        .warga-form-container .card { display:block; }

        .warga-form-container .primary { background:#15803d; color:white; }

        
        .warga-form-container select {
            min-height: 46px;
            color: #1e293b;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
        }

        .warga-form-container select:hover {
            border-color: #15803d;
        }

        .warga-form-container select:focus {
            outline: none;
            border-color: #15803d;
            box-shadow: 0 0 0 3px rgba(21, 128, 61, .12);
        }

        .warga-form-container select option {
            padding: 10px;
            color: #1e293b;
            background: #fff;
        }

</style>
@endpush

@section('content')
<div class="warga-form-container">
    <div class="top">
        <h1>Tambah Warga</h1>
        <p class="muted">Lengkapi informasi warga pada formulir di bawah ini.</p>
    </div>

    @if ($errors->any())
        <div class="alert">
            <b>Data belum bisa disimpan:</b>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.warga.store') }}" method="POST" class="card">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="nik">NIK *</label>
                <input
                    type="text"
                    id="nik"
                    name="nik"
                    value="{{ old('nik') }}"
                    inputmode="numeric"
                    pattern="[0-9]{16}"
                    minlength="16"
                    maxlength="16"
                    placeholder="16 digit NIK"
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
                    value="{{ old('nama') }}"
                    maxlength="100"
                    placeholder="Nama lengkap warga"
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
                    value="{{ old('no_kk') }}"
                    inputmode="numeric"
                    pattern="[0-9]{16}"
                    minlength="16"
                    maxlength="16"
                    placeholder="16 digit nomor KK"
                >
                @error('no_kk') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input
                    type="tel"
                    id="no_telepon"
                    name="no_telepon"
                    value="{{ old('no_telepon') }}"
                    maxlength="20"
                    placeholder="Contoh: 081234567890"
                >
                @error('no_telepon') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group full">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea
                    id="alamat"
                    name="alamat"
                    placeholder="Nama jalan, nomor rumah, RT/RW..."
                    required
                >{{ old('alamat') }}</textarea>
                @error('alamat') <div class="error">{{ $message }}</div> @enderror
            </div>



            <div class="form-group full">
                <label for="status">Status Warga *</label>
                <select id="status" name="status" required>
                    <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="pindah" {{ old('status') === 'pindah' ? 'selected' : '' }}>
                        Pindah
                    </option>
                    <option value="meninggal" {{ old('status') === 'meninggal' ? 'selected' : '' }}>
                        Meninggal
                    </option>
                </select>
                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group full">
                <label for="status_keluarga">Status dalam Keluarga *</label>
                <select id="status_keluarga" name="status_keluarga" required>
                    <option value="">-- Pilih Status Keluarga --</option>
                    <option value="Kepala Keluarga" {{ old('status_keluarga') === 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                    <option value="Istri / Suami" {{ old('status_keluarga') === 'Istri / Suami' ? 'selected' : '' }}>Istri / Suami</option>
                    <option value="Anak" {{ old('status_keluarga') === 'Anak' ? 'selected' : '' }}>Anak</option>
                    <option value="Orang Tua" {{ old('status_keluarga') === 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="Wali" {{ old('status_keluarga') === 'Wali' ? 'selected' : '' }}>Wali</option>
                    <option value="Anggota Keluarga Lainnya" {{ old('status_keluarga') === 'Anggota Keluarga Lainnya' ? 'selected' : '' }}>Anggota Keluarga Lainnya</option>
                </select>
                <span class="hint">Pilih satu status yang sesuai dengan posisi warga dalam KK.</span>
                @error('status_keluarga')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="actions">
            <a href="{{ route('admin.warga.index') }}" class="btn secondary">Batal</a>
            <button type="submit" class="btn primary">Simpan Data Warga</button>
        </div>
    </form>
</div>
@endsection
