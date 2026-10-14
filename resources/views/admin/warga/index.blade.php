@extends('layouts.admin')

@section('title', 'Data Warga | Smart RT')

@push('styles')
<style>
        * { box-sizing: border-box; }
        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }
        .warga-index h2 { margin: 0 0 8px; font-size: 25px; }
        .muted { color: #64748b; font-size: 14px; line-height: 1.6; }
        .warga-index .btn {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            padding: 11px 15px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }
        .warga-index .btn-primary { background: #15803d; color: white; }
        .warga-index .btn-secondary { background: #e2e8f0; color: #334155; }
        .warga-index .btn-danger { background: #fee2e2; color: #b91c1c; }
        .warga-index .btn:hover { opacity: .85; }
        .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0,0,0,.03);
        }
        .toolbar {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .toolbar input {
            flex: 1;
            min-width: 0;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }
        .table-wrap { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; white-space: nowrap; }
        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #edf0ed;
            font-size: 13px;
        }
        th {
            color: #64748b;
            background: #f8faf9;
            font-size: 12px;
            text-transform: uppercase;
        }
        td { vertical-align: middle; }
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
        }
        .badge-inactive { background: #f1f5f9; color: #475569; }
        .actions { display: flex; gap: 7px; align-items: center; }
        .actions form { margin: 0; }
        .actions .warga-index .btn { padding: 8px 10px; font-size: 12px; }
        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 14px;
        }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-error { background: #fee2e2; color: #991b1b; }
        .pagination { margin-top: 20px; }
        @media(max-width: 600px) {
            .panel { padding: 12px; }
            .toolbar { flex-direction: column; }
            .page-heading .warga-index h2 { font-size: 22px; }
        }
    </style>
@endpush

@section('content')
<div class="warga-index">
    <div class="page-heading">
        <div>
            <h2>Data Warga</h2>
            <p class="muted">Kelola data warga dan kepala keluarga di lingkungan RT.</p>
        </div>

        <a href="{{ route('admin.warga.create') }}" class="btn btn-primary">
            + Tambah Warga
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="panel">
        <form action="{{ route('admin.warga.index') }}" method="GET" class="toolbar">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau NIK warga..."
            >
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama Warga</th>
                        <th>No. KK</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wargas as $warga)
                        <tr>
                            <td>{{ $wargas->firstItem() + $loop->index }}</td>
                            <td>{{ $warga->nik }}</td>
                            <td>{{ $warga->nama }}</td>
                            <td>{{ $warga->no_kk ?: '-' }}</td>
                            <td>{{ $warga->alamat }}</td>
                            <td>{{ $warga->no_telepon ?: '-' }}</td>
                            <td>
                                <span class="badge {{ $warga->status === 'aktif' ? '' : 'badge-inactive' }}">
                                    {{ ucfirst($warga->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a
                                        href="{{ route('admin.warga.edit', $warga) }}"
                                        class="btn btn-secondary"
                                    >Edit</a>

                                    <form
                                        action="{{ route('admin.warga.destroy', $warga) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data warga ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:30px">
                                Belum ada data warga.
                                Silakan klik <b>Tambah Warga</b> untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $wargas->withQueryString()->links() }}
        </div>
    </section>

    <div style="margin-top:24px;">
        <a href="{{ route('admin.dashboard') }}"
        style="display:inline-block;background:#166534;color:white;
                padding:12px 18px;border-radius:8px;text-decoration:none;">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection