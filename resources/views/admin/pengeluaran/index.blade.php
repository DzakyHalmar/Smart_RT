@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-3">Pengeluaran Kas RT</h2>
    <p class="text-muted">
        Kelola dan pantau pengeluaran kas RT secara transparan.
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Periksa kembali data yang kamu masukkan.
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <p class="text-muted mb-1">Total Pengeluaran</p>
            <h3 class="text-danger">
                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Riwayat Pengeluaran</h5>

        <a href="{{ route('admin.pengeluaran.create') }}"
           class="btn btn-success">
            + Tambah Pengeluaran
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengeluaran as $item)
                    <tr>
                        <td>
                            {{ $pengeluaran->firstItem() + $loop->index }}
                        </td>
                        <td>
                            {{ $item->tanggal_pengeluaran->format('d-m-Y') }}
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td class="text-danger">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.pengeluaran.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            Belum ada data pengeluaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pengeluaran->links() }}
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