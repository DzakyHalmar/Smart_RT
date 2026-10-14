@extends('layouts.admin')
@section('content')
<div class="container" style="max-width:800px;padding-top:30px;padding-bottom:40px;">
    <h1>Tambah Iuran Warga</h1>
    <p>Masukkan informasi iuran warga dengan benar.</p>

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:20px;">
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.iuran.store') }}" method="POST"
          style="background:white;padding:24px;border-radius:12px;box-shadow:0 2px 10px #0000000d;">
        @csrf

        <div style="margin-bottom:18px;">
            <label for="warga_id">Nama Warga</label>
            <select name="warga_id" id="warga_id" required
                    style="display:block;width:100%;padding:12px;margin-top:6px;border:1px solid #d1d5db;border-radius:8px;">
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $item)
                    <option value="{{ $item->id }}" {{ old('warga_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }} — {{ $item->nik }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:18px;">
            <label for="jenis_iuran">Jenis Iuran</label>
            <input type="text" name="jenis_iuran" id="jenis_iuran"
                   value="{{ old('jenis_iuran') }}" placeholder="Contoh: Iuran Kebersihan Oktober 2026"
                   maxlength="100" required
                   style="display:block;width:100%;padding:12px;margin-top:6px;border:1px solid #d1d5db;border-radius:8px;">
        </div>

        <div style="margin-bottom:18px;">
            <label for="nominal">Nominal (Rp)</label>
            <input type="number" name="nominal" id="nominal"
                   value="{{ old('nominal') }}" min="1" step="1" placeholder="Contoh: 50000" required
                   style="display:block;width:100%;padding:12px;margin-top:6px;border:1px solid #d1d5db;border-radius:8px;">
        </div>

        <div style="margin-bottom:18px;">
            <label for="tanggal_iuran">Tanggal Iuran</label>
            <input type="date" name="tanggal_iuran" id="tanggal_iuran"
                   value="{{ old('tanggal_iuran', date('Y-m-d')) }}" required
                   style="display:block;width:100%;padding:12px;margin-top:6px;border:1px solid #d1d5db;border-radius:8px;">
        </div>

        <div style="margin-bottom:24px;">
            <label for="status">Status Pembayaran</label>
            <select name="status" id="status" required
                    style="display:block;width:100%;padding:12px;margin-top:6px;border:1px solid #d1d5db;border-radius:8px;">
                <option value="belum_bayar" {{ old('status', 'belum_bayar') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>

        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <button type="submit"
                    style="background:#166534;color:white;border:0;padding:12px 20px;border-radius:8px;cursor:pointer;">
                Simpan Iuran
            </button>

            <a href="{{ route('admin.iuran.index') }}"
               style="background:#e5e7eb;color:#374151;padding:12px 20px;border-radius:8px;text-decoration:none;">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
