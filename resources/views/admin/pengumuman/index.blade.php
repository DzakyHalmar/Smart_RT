
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Data Pengumuman</h2>
            <p class="text-muted mb-0">Kelola pengumuman untuk warga RT.</p>
        </div>

        <a href="{{ route('admin.pengumuman.create') }}"
           class="btn btn-success">
            + Tambah Pengumuman
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengumuman as $item)
                    <tr>
                        <td>{{ $pengumuman->firstItem() + $loop->index }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                        <td>
                            @if ($item->status === 'published')
                                <span class="badge bg-success">Dipublikasikan</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            Belum ada pengumuman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $pengumuman->links() }}
        </div>
    </div>
</div>
@endsection
