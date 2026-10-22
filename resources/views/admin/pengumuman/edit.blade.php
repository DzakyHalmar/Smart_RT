
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <h2 class="mb-4">Edit Pengumuman</h2>

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
            <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Pengumuman</label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ old('judul', $pengumuman->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Pengumuman</label>
                    <textarea name="isi" class="form-control" rows="5"
                              required>{{ old('isi', $pengumuman->isi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pengumuman</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ old('tanggal', $pengumuman->tanggal->format('Y-m-d')) }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status Publikasi</label>
                    <select name="status" class="form-select" required>
                        <option value="draft"
                            {{ old('status', $pengumuman->status) === 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                        <option value="published"
                            {{ old('status', $pengumuman->status) === 'published' ? 'selected' : '' }}>
                            Dipublikasikan
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.pengumuman.index') }}"
                   class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
