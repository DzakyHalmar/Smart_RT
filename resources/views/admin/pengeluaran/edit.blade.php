@extends('layouts.admin')

@section('title', 'Edit Pengeluaran | Smart RT')

@push('styles')
<style>
    .pengeluaran-form-container {
        max-width: 760px;
        margin: 0 auto;
        padding: 10px 0 30px;
        color: #1e293b;
    }

    .pengeluaran-form-container * {
        box-sizing: border-box;
    }

    .pengeluaran-form-container .top {
        margin-bottom: 22px;
    }

    .pengeluaran-form-container .top a {
        color: #15803d;
        text-decoration: none;
        font-size: 14px;
    }

    .pengeluaran-form-container h1 {
        font-size: 26px;
        margin: 18px 0 8px;
    }

    .pengeluaran-form-container .muted {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .pengeluaran-form-container .form-card {
        background: #fff;
        padding: 28px;
        border: 1px solid #e5e7eb;
        border-radius: 15px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .04);
    }

    .pengeluaran-form-container .form-group {
        margin-bottom: 20px;
    }

    .pengeluaran-form-container label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .pengeluaran-form-container input,
    .pengeluaran-form-container select,
    .pengeluaran-form-container textarea {
        width: 100%;
        padding: 12px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font-family: inherit;
        font-size: 14px;
    }

    .pengeluaran-form-container input:focus,
    .pengeluaran-form-container select:focus,
    .pengeluaran-form-container textarea:focus {
        outline: 2px solid #bbf7d0;
        border-color: #15803d;
    }

    .pengeluaran-form-container textarea {
        min-height: 100px;
        resize: vertical;
    }

    .pengeluaran-form-container .error {
        color: #b91c1c;
        font-size: 12px;
        margin-top: 6px;
    }

    .pengeluaran-form-container .alert {
        padding: 13px 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        background: #fee2e2;
        color: #991b1b;
        font-size: 14px;
    }

    .pengeluaran-form-container .actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 5px;
    }

    .pengeluaran-form-container .btn {
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

    .pengeluaran-form-container .primary {
        background: #15803d;
        color: #fff;
    }

    .pengeluaran-form-container .primary:hover {
        background: #166534;
    }

    .pengeluaran-form-container .secondary {
        background: #e2e8f0;
        color: #334155;
    }

    .pengeluaran-form-container .secondary:hover {
        background: #cbd5e1;
    }

    @media (max-width: 580px) {
        .pengeluaran-form-container .form-card {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="pengeluaran-form-container">

    <div class="top">
        <h1>Edit Data Pengeluaran</h1>

        <p class="muted">
            Perbarui informasi transaksi pengeluaran RT.
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
        action="{{ route('admin.pengeluaran.update', $pengeluaran) }}"
        method="POST"
        class="form-card"
    >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="keterangan">Keterangan Pengeluaran *</label>
            <input
                type="text"
                id="keterangan"
                name="keterangan"
                value="{{ old('keterangan', $pengeluaran->keterangan) }}"
                placeholder="Contoh: Pembelian alat kebersihan"
                maxlength="255"
                required
            >
            @error('keterangan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nominal">Nominal Pengeluaran (Rp) *</label>
            <input
                type="number"
                id="nominal"
                name="nominal"
                value="{{ old('nominal', (int) $pengeluaran->nominal) }}"
                min="1"
                step="1"
                placeholder="Contoh: 200000"
                required
            >
            @error('nominal')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_pengeluaran">Tanggal Pengeluaran *</label>
            <input
                type="date"
                id="tanggal_pengeluaran"
                name="tanggal_pengeluaran"
                value="{{ old('tanggal_pengeluaran', $pengeluaran->tanggal_pengeluaran) }}"
                required
            >
            @error('tanggal_pengeluaran')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kategori">Kategori Pengeluaran *</label>
            <input
                type="text"
                id="kategori"
                name="kategori"
                value="{{ old('kategori', $pengeluaran->kategori) }}"
                placeholder="Contoh: Kebersihan, Keamanan"
                maxlength="100"
                required
            >
            @error('kategori')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea
                id="catatan"
                name="catatan"
                rows="4"
                placeholder="Catatan tambahan jika diperlukan"
            >{{ old('catatan', $pengeluaran->catatan) }}</textarea>
            @error('catatan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="actions">
            <button type="submit" class="btn primary">
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.pengeluaran.index') }}"
                class="btn secondary"
            >
                Batal
            </a>
        </div>
    </form>

</div>
@endsection
