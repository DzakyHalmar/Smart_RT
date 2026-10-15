@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-2">Tambah Pengeluaran</h2>
    <p class="text-muted mb-4">
        Masukkan informasi pengeluaran kas RT dengan benar.
    </p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum valid!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.pengeluaran.store') }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label for="keterangan" class="form-label">
                        Keterangan Pengeluaran
                    </label>
                    <input
                        type="text"
                        id="keterangan"
                        name="keterangan"
                        class="form-control"
                        value="{{ old('keterangan') }}"
                        placeholder="Contoh: Pembayaran listrik balai RT"
                        maxlength="255"
                        required>
                </div>

                <div class="mb-3">
                    <label for="nominal" class="form-label">
                        Nominal (Rp)
                    </label>
                    <input
                        type="number"
                        id="nominal"
                        name="nominal"
                        class="form-control"
                        value="{{ old('nominal') }}"
                        placeholder="Contoh: 150000"
                        min="1"
                        step="0.01"
                        required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pengeluaran" class="form-label">
                        Tanggal Pengeluaran
                    </label>
                    <input
                        type="date"
                        id="tanggal_pengeluaran"
                        name="tanggal_pengeluaran"
                        class="form-control"
                        value="{{ old('tanggal_pengeluaran', date('Y-m-d')) }}"
                        required>
                </div>

                <div class="mb-4">
                    <label for="kategori" class="form-label">
                        Kategori Pengeluaran
                    </label>
                    <select
                        id="kategori"
                        name="kategori"
                        class="form-select"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Operasional"
                            @selected(old('kategori') == 'Operasional')>
                            Operasional
                        </option>
                        <option value="Kebersihan"
                            @selected(old('kategori') == 'Kebersihan')>
                            Kebersihan
                        </option>
                        <option value="Keamanan"
                            @selected(old('kategori') == 'Keamanan')>
                            Keamanan
                        </option>
                        <option value="Kegiatan Warga"
                            @selected(old('kategori') == 'Kegiatan Warga')>
                            Kegiatan Warga
                        </option>
                        <option value="Lainnya"
                            @selected(old('kategori', 'Lainnya') == 'Lainnya')>
                            Lainnya
                        </option>
                    </select>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-success">
                        Simpan Pengeluaran
                    </button>

                    <a href="{{ route('admin.pengeluaran.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection