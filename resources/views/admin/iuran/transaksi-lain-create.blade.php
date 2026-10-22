
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Tambah Transaksi Lain</h3>
            <p class="text-muted mb-0">
                Tambahkan pemasukan selain iuran bulanan.
            </p>
        </div>

        <a href="{{ route('admin.transaksi-lain.index') }}"
           class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.transaksi-lain.store') }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Jenis Transaksi</label>
                    <input type="text"
                           name="jenis_iuran"
                           class="form-control"
                           value="{{ old('jenis_iuran') }}"
                           placeholder="Contoh: Sumbangan, Kasbon"
                           required>
                    <small class="text-muted">
                        Jangan isi dengan Iuran Bulanan.
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nominal (Rp)</label>
                    <input type="number"
                           name="nominal"
                           class="form-control"
                           min="1"
                           value="{{ old('nominal') }}"
                           placeholder="Masukkan nominal"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Transaksi</label>
                    <input type="date"
                           name="tanggal_iuran"
                           class="form-control"
                           value="{{ old('tanggal_iuran', date('Y-m-d')) }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="lunas"
                            {{ old('status') == 'lunas' ? 'selected' : '' }}>
                            Lunas
                        </option>
                        <option value="belum_bayar"
                            {{ old('status') == 'belum_bayar' ? 'selected' : '' }}>
                            Belum Dibayar
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan Transaksi
                </button>

                <a href="{{ route('admin.transaksi-lain.index') }}"
                   class="btn btn-light">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>
@endsection
