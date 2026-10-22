
@extends('layouts.app')

@section('title', 'Keluhan Warga')

@section('content')
<style>
    .keluhan-page {
        padding: 40px 0 64px;
    }

    .keluhan-header {
        margin-bottom: 26px;
    }

    .keluhan-header h1 {
        margin: 8px 0;
        color: #183b32;
    }

    .keluhan-header p {
        color: #64748b;
    }

    .keluhan-alert {
        padding: 14px 18px;
        border-radius: 10px;
        background: #e7f7ee;
        color: #176b45;
        margin-bottom: 20px;
    }

    .keluhan-panel {
        background: #fff;
        border: 1px solid #e5ebe7;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 6px 24px rgba(20, 50, 40, .05);
    }

    .keluhan-table-wrap {
        overflow-x: auto;
    }

    .keluhan-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }

    .keluhan-table th {
        padding: 15px 12px;
        text-align: left;
        font-size: 13px;
        color: #52665d;
        background: #f5f8f6;
        border-bottom: 1px solid #e2e9e4;
    }

    .keluhan-table td {
        padding: 17px 12px;
        vertical-align: top;
        border-bottom: 1px solid #edf1ee;
        font-size: 14px;
    }

    .keluhan-table tbody tr:hover {
        background: #fbfdfb;
    }

    .keluhan-judul {
        font-weight: 700;
        color: #243b32;
        margin-bottom: 7px;
    }

    .keluhan-kategori {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #eef4f0;
        color: #456557;
        font-size: 12px;
    }

    .keluhan-isi {
        max-width: 320px;
        margin: 10px 0 0;
        color: #5f6d65;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        line-height: 1.6;
    }

    .keluhan-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff3d6;
        color: #946200;
    }

    .status-diproses {
        background: #e3efff;
        color: #2459a6;
    }

    .status-selesai {
        background: #dcf7e7;
        color: #187044;
    }

    .keluhan-actions {
        min-width: 160px;
    }

    .keluhan-select {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 9px;
        border: 1px solid #d8e1db;
        border-radius: 8px;
        background: #fff;
        color: #263b31;
        font-size: 13px;
    }

    .keluhan-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .keluhan-btn-save {
        background: #176b55;
        color: #fff;
    }

    .keluhan-btn-save:hover {
        background: #105440;
        color: #fff;
    }

    .keluhan-btn-delete {
        margin-top: 8px;
        background: #fff0ef;
        color: #bd3434;
        border: 1px solid #f3d1ce;
    }

    .keluhan-btn-delete:hover {
        background: #bd3434;
        color: #fff;
    }

    .keluhan-empty {
        text-align: center;
        padding: 36px 16px !important;
        color: #718078;
    }

    .keluhan-pagination {
        margin-top: 22px;
    }

    
    
    .keluhan-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .keluhan-btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 16px;
        background: #176b55;
        color: #ffffff;
        border-radius: 9px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: background 0.2s ease;
    }

    .keluhan-btn-back:hover {
        background: #105440;
        color: #ffffff;
    }

    @media (max-width: 600px) {
        .keluhan-header-top {
            align-items: flex-start;
        }
    }



    @media (max-width: 600px) {
        .keluhan-page {
            padding-top: 25px;
        }

        .keluhan-panel {
            padding: 12px;
        }
    }
</style>

<section class="container keluhan-page">
    
    
    <div class="keluhan-header">
        <div class="keluhan-header-top">
            <div>
                <span class="section-kicker">PANEL ADMINISTRASI</span>
                <h1>Keluhan Warga</h1>
                <p>Kelola laporan dan pantau tindak lanjut keluhan warga.</p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
            class="keluhan-btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>



    @if (session('success'))
        <div class="keluhan-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="keluhan-alert" style="background:#fff0ef;color:#a52a2a;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="keluhan-panel">
        <div class="keluhan-table-wrap">
            <table class="keluhan-table">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Detail Keluhan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($keluhan as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->nama }}</strong>
                            </td>

                            <td>
                                <div class="keluhan-judul">
                                    {{ $item->judul }}
                                </div>

                                <span class="keluhan-kategori">
                                    {{ $item->kategori }}
                                </span>

                                <p class="keluhan-isi">{{ $item->isi }}</p>
                            </td>

                            <td>
                                {{ $item->created_at->format('d-m-Y') }}
                                <div style="color:#87938c;font-size:12px;margin-top:4px;">
                                    {{ $item->created_at->format('H:i') }}
                                </div>
                            </td>

                            <td>
                                @php
                                    $statusClass = match ($item->status) {
                                        'Menunggu' => 'status-menunggu',
                                        'Diproses' => 'status-diproses',
                                        'Selesai' => 'status-selesai',
                                        default => 'status-menunggu',
                                    };
                                @endphp

                                <span class="keluhan-status {{ $statusClass }}">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td class="keluhan-actions">
                                <form
                                    action="{{ route('admin.keluhan.update', $item) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        class="keluhan-select"
                                        required
                                    >
                                        @foreach (['Menunggu', 'Diproses', 'Selesai'] as $status)
                                            <option
                                                value="{{ $status }}"
                                                @selected($item->status === $status)
                                            >
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit"
                                            class="keluhan-btn keluhan-btn-save">
                                        <i class="bi bi-check-circle"></i>
                                        Simpan Status
                                    </button>
                                </form>

                                <form
                                    action="{{ route('admin.keluhan.destroy', $item) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus keluhan ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="keluhan-btn keluhan-btn-delete">
                                        <i class="bi bi-trash"></i>
                                        Hapus Keluhan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="keluhan-empty">
                                <i class="bi bi-inbox" style="font-size:32px;"></i>
                                <p>Belum ada keluhan dari warga.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="keluhan-pagination">
            {{ $keluhan->links() }}
        </div>
    </div>
</section>
@endsection
