@extends('layouts.admin')

@section('title', 'Edit Pengurus | Smart RT')

@push('styles')
<style>
    .pengurus-form-container {
        max-width: 760px;
        margin: 0 auto;
        padding: 10px 0 30px;
        color: #1e293b;
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

    .pengurus-form-container .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .pengurus-form-container .form-group {
        margin-bottom: 20px;
    }

    .pengurus-form-container .full {
        grid-column: 1 / -1;
    }

    .pengurus-form-container label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .pengurus-form-container input,
    .pengurus-form-container select,
    .pengurus-form-container textarea {
        box-sizing: border-box;
        width: 100%;
        padding: 12px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font: inherit;
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
        gap: 10px;
        justify-content: flex-end;
        margin-top: 5px;
    }

    .pengurus-form-container .btn {
        display: inline-block;
        padding: 12px 17px;
        border: 0;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
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

    @media (max-width: 580px) {
        .pengurus-form-container .form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .pengurus-form-container .full {
            grid-column: auto;
        }

        .pengurus-form-container .form-card {
            padding: 20px;
        }

        .pengurus-form-container .actions {
            flex-direction: column-reverse;
        }

        .pengurus-form-container .actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="pengurus-form-container">

    <div class="top">
        <h1>Edit Data Pengurus</h1>

        <p class="muted">
            Perbarui informasi pengurus RT dengan benar.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert">
            <strong>Data belum bisa diperbarui:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.pengurus.update', ['pengurus' => $pengurus->id]) }}"
        method="POST"
        class="form-card"
    >
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label for="nama">Nama Pengurus *</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama', $pengurus->nama) }}"
                    maxlength="100"
                    required
                >
                @error('nama')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan *</label>
                <input
                    type="text"
                    id="jabatan"
                    name="jabatan"
                    value="{{ old('jabatan', $pengurus->jabatan) }}"
                    maxlength="100"
                    required
                >
                @error('jabatan')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input
                    type="tel"
                    id="no_telepon"
                    name="no_telepon"
                    value="{{ old('no_telepon', $pengurus->no_telepon) }}"
                    maxlength="20"
                >
                @error('no_telepon')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="aktif"
                        {{ old('status', $pengurus->status) === 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="nonaktif"
                        {{ old('status', $pengurus->status) === 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="actions">
            <a
                href="{{ route('admin.pengurus.index') }}"
                class="btn secondary"
            >
                Batal
            </a>

            <button type="submit" class="btn primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
