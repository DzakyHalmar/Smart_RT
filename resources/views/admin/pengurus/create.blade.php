@extends('layouts.admin')

@section('title', 'Tambah Pengurus | Smart RT')

@push('styles')
<style>
    .pengurus-form-container {
        max-width: 760px;
        margin: 0 auto;
        padding: 10px 0 30px;
        color: #1e293b;
    }

    .pengurus-form-container * {
        box-sizing: border-box;
    }

    .pengurus-form-container .top {
        margin-bottom: 22px;
    }

    .pengurus-form-container .top a {
        color: #15803d;
        text-decoration: none;
        font-size: 14px;
    }

    .pengurus-form-container h1 {
        font-size: 26px;
        margin: 18px 0 8px;
    }

    .pengurus-form-container .muted {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .pengurus-form-container .form-card {
        background: #fff;
        padding: 28px;
        border: 1px solid #e5e7eb;
        border-radius: 15px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .04);
    }

    .pengurus-form-container .form-group {
        margin-bottom: 20px;
    }

    .pengurus-form-container label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .pengurus-form-container input,
    .pengurus-form-container select,
    .pengurus-form-container textarea {
        width: 100%;
        padding: 12px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font-family: inherit;
        font-size: 14px;
    }

    .pengurus-form-container input:focus,
    .pengurus-form-container select:focus,
    .pengurus-form-container textarea:focus {
        outline: 2px solid #bbf7d0;
        border-color: #15803d;
    }

    .pengurus-form-container textarea {
        min-height: 100px;
        resize: vertical;
    }

    .pengurus-form-container .hint {
        display: block;
        margin-top: 6px;
        color: #64748b;
        font-size: 12px;
    }

    .pengurus-form-container .error {
        color: #b91c1c;
        font-size: 12px;
        margin-top: 6px;
    }

    .pengurus-form-container .alert {
        padding: 13px 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        background: #fee2e2;
        color: #991b1b;
        font-size: 14px;
    }

    .pengurus-form-container .actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 5px;
    }

    .pengurus-form-container .btn {
        display: block;
        width: 100%;
        padding: 12px 17px;
        border: 0;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
        transition: background .2s ease;
    }

    .pengurus-form-container .primary {
        background: #15803d;
        color: #fff;
    }

    .pengurus-form-container .primary:hover {
        background: #166534;
    }

    .pengurus-form-container .secondary {
        background: #e2e8f0;
        color: #334155;
    }

    .pengurus-form-container .secondary:hover {
        background: #cbd5e1;
    }

    @media (max-width: 580px) {
        .pengurus-form-container .form-card {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="pengurus-form-container">

    <div class="top">

        <h1>Tambah Pengurus</h1>

        <p class="muted">
            Lengkapi informasi pengurus RT pada formulir di bawah ini.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert">
            <strong>Data belum bisa disimpan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.pengurus.store') }}"
        method="POST"
        class="form-card"
    >
        @csrf

        <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input
                type="text"
                name="nama"
                id="nama"
                value="{{ old('nama') }}"
                placeholder="Masukkan nama lengkap"
                maxlength="100"
                required
            >
            @error('nama')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan *</label>
            <select name="jabatan" id="jabatan" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach ([
                    'Ketua RT',
                    'Wakil Ketua RT',
                    'Sekretaris',
                    'Bendahara',
                    'Seksi Keamanan',
                    'Seksi Kebersihan',
                    'Seksi Sosial',
                ] as $jabatan)
                    <option
                        value="{{ $jabatan }}"
                        @selected(old('jabatan') === $jabatan)
                    >
                        {{ $jabatan }}
                    </option>
                @endforeach
            </select>
            @error('jabatan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="no_telepon">Nomor Telepon</label>
            <input
                type="tel"
                name="no_telepon"
                id="no_telepon"
                value="{{ old('no_telepon') }}"
                placeholder="Contoh: 081234567890"
                maxlength="20"
            >
            @error('no_telepon')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea
                name="alamat"
                id="alamat"
                rows="3"
                placeholder="Masukkan alamat pengurus"
            >{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="actions">
            <button type="submit" class="btn primary">
                Simpan Pengurus
            </button>

            <a
                href="{{ route('admin.pengurus.index') }}"
                class="btn secondary"
            >
                Batal
            </a>
        </div>
    </form>

</div>
@endsection
