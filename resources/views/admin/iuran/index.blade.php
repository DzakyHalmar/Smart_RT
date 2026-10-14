@extends('layouts.admin')
@section('content')
<div class="container" style="padding-top: 30px; padding-bottom: 40px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; gap:12px; flex-wrap:wrap;">
        <div>
            <h1>Data Iuran RT</h1>
            <p>Kelola dan pantau pembayaran iuran warga.</p>
        </div>

        <a href="{{ route('admin.iuran.create') }}"
           style="background:#166534;color:white;padding:10px 16px;border-radius:8px;text-decoration:none;">
            + Tambah Iuran
        </a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:16px;">
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="overflow-x:auto;background:white;border-radius:12px;padding:16px;box-shadow:0 2px 10px #0000000d;">
        <table style="width:100%;border-collapse:collapse;min-width:700px;">
            <thead>
                <tr style="background:#f0fdf4;text-align:left;">
                    <th style="padding:12px;">No.</th>
                    <th style="padding:12px;">Nama Warga</th>
                    <th style="padding:12px;">Jenis Iuran</th>
                    <th style="padding:12px;">Nominal</th>
                    <th style="padding:12px;">Tanggal</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($iuran as $item)
                    <tr style="border-bottom:1px solid #e5e7eb;">
                        <td style="padding:12px;">{{ $iuran->firstItem() + $loop->index }}</td>
                        <td style="padding:12px;">{{ $item->warga->nama ?? 'Warga tidak ditemukan' }}</td>
                        <td style="padding:12px;">{{ $item->jenis_iuran }}</td>
                        <td style="padding:12px;">Rp {{ number_format((float)$item->nominal, 0, ',', '.') }}</td>
                        <td style="padding:12px;">{{ $item->tanggal_iuran->format('d-m-Y') }}</td>
                        <td style="padding:12px;">
                            @if($item->status === 'lunas')
                                <span style="background:#dcfce7;color:#166534;padding:5px 9px;border-radius:20px;">Lunas</span>
                            @else
                                <span style="background:#fef3c7;color:#92400e;padding:5px 9px;border-radius:20px;">Belum Bayar</span>
                            @endif
                        </td>
                        <td style="padding:12px;white-space:nowrap;">
                            <a href="{{ route('admin.iuran.edit', $item->id) }}">Edit</a>

                            <form action="{{ route('admin.iuran.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus data iuran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#dc2626;border:0;background:none;cursor:pointer;margin-left:8px;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:24px;text-align:center;color:#6b7280;">
                            Belum ada data iuran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $iuran->links() }}
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