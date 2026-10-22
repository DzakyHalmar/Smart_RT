
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Transaksi Lain</h2>
            <p class="text-muted mb-0">
                Kelola transaksi selain iuran bulanan warga.
            </p>
        </div>

        <a href="{{ route('admin.transaksi-lain.create') }}"
           class="btn btn-success">
            + Tambah Transaksi Lain
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Jenis Transaksi</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($transaksi as $item)
                            <tr>
                                <td>
                                    {{ $transaksi->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $item->jenis_iuran }}</strong>
                                </td>

                                <td>
                                    Rp{{ number_format($item->nominal, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_iuran)->format('d-m-Y') }}
                                </td>

                                <td>
                                    @if ($item->status === 'lunas')
                                        <span class="badge bg-success">
                                            Lunas
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Belum bayar
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.transaksi-lain.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.transaksi-lain.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Belum ada transaksi lain.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $transaksi->links() }}
            </div>

        </div>
    </div>

    <a href="{{ route('admin.iuran.index') }}"
       class="btn btn-outline-secondary mt-4">
        Kembali ke Buku Iuran Bulanan
    </a>

</div>
@endsection
