
@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="mb-1">Galeri Foto</h1>
            <p class="text-muted mb-0">
                Tambahkan atau hapus foto kegiatan RT.
            </p>
        </div>
        <span class="badge text-bg-success fs-6">
            {{ $galeri->count() }} Foto
        </span>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Tambah Foto Baru</h5>

            <form action="{{ route('admin.galeri.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">
                        Pilih foto
                    </label>
                    <input type="file"
                        class="form-control"
                        id="foto"
                        name="foto"
                        accept=".jpg,.jpeg,.png,.webp"
                        required>
                    <small class="text-muted">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                    </small>
                </div>

                <button type="submit" class="btn btn-success px-4">
                    Upload Foto
                </button>
            </form>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Foto Tersimpan</h5>

    <div class="row g-4">
        @forelse ($galeri as $item)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img
                        src="{{ asset('storage/' . $item->path_file) }}"
                        alt="Foto kegiatan RT"
                        class="w-100"
                        style="height:220px; object-fit:cover;">

                    <div class="card-body d-flex justify-content-between
                        align-items-center gap-2">
                        <span class="small text-muted text-truncate"
                            title="{{ $item->nama_file }}">
                            {{ $item->nama_file }}
                        </span>

                        <form
                            action="{{ route('admin.galeri.destroy', $item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-outline-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center bg-white rounded-4 shadow-sm p-5">
                    <h5 class="fw-bold">Belum ada foto</h5>
                    <p class="text-muted mb-0">
                        Upload foto pertama untuk galeri kegiatan RT.
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    <div style="margin-top:24px;">
        <a href="{{ route('admin.dashboard') }}"
        style="display:inline-block;background:#166534;color:white;
                padding:12px 18px;border-radius:8px;text-decoration:none;">
            Kembali ke Dashboard
        </a>
    </div>

</div>
@endsection
