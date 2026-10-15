@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-2">Tambah Pengurus</h2>
    <p class="text-muted mb-4">
        Masukkan informasi pengurus RT.
    </p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.pengurus.store') }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        maxlength="100"
                        required>
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label">
                        Jabatan
                    </label>
                    <select
                        name="jabatan"
                        id="jabatan"
                        class="form-select"
                        required>
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
                            <option value="{{ $jabatan }}"
                                @selected(old('jabatan') === $jabatan)>
                                {{ $jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">
                        Nomor Telepon
                    </label>
                    <input
                        type="text"
                        name="no_telepon"
                        id="no_telepon"
                        class="form-control"
                        value="{{ old('no_telepon') }}"
                        placeholder="Contoh: 081234567890"
                        maxlength="20">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        Alamat
                    </label>
                    <textarea
                        name="alamat"
                        id="alamat"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan alamat pengurus">{{ old('alamat') }}</textarea>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-success">
                        Simpan Pengurus
                    </button>

                    <a href="{{ route('admin.pengurus.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection