@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-2">Data Pengurus RT</h2>
    <p class="text-muted mb-4">
        Kelola informasi ketua RT, sekretaris, bendahara,
        dan pengurus lainnya.
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center
                flex-wrap gap-2 mb-3">
        <h5 class="mb-0">Daftar Pengurus</h5>

        <a href="{{ route('admin.pengurus.create') }}"
           class="btn btn-success">
            + Tambah Pengurus
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-striped
                          align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengurus as $item)
                        <tr>
                            <td>
                                {{ $pengurus->firstItem() + $loop->index }}
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->no_telepon ?: '-' }}</td>
                            <td>{{ $item->alamat ?: '-' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a
                                        href="{{ route('admin.pengurus.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.pengurus.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="text-center py-4">
                                Belum ada data pengurus.
                                Silakan tambahkan data terlebih dahulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pengurus->links() }}
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