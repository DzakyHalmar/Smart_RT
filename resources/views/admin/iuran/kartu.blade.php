@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 no-print">
        <div>
            <h2 class="fw-bold mb-1">Kartu Iuran Bulanan</h2>
            <p class="text-muted mb-0">Tahun {{ $tahun }}</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.iuran.index', ['tahun' => $tahun]) }}"
               class="btn btn-outline-secondary">
                Kembali
            </a>

            <button onclick="window.print()" class="btn btn-success">
                Cetak Kartu
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success no-print">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger no-print">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card border-0 shadow-sm p-3 p-md-4 kartu-iuran">

        <div class="text-center border-bottom pb-3 mb-4">
            <h2 class="fw-bold mb-1">KARTU IURAN BULANAN</h2>
            <h5 class="fw-semibold mb-1">RT 001 / RW 012</h5>
            <p class="text-muted mb-0">
                Kebayoran Lama Selatan, Jakarta Selatan
            </p>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-2">
                <strong>Nama Warga:</strong>
                {{ $warga->nama }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>NIK:</strong>
                {{ $warga->nik }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Alamat:</strong>
                {{ $warga->alamat }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Tahun:</strong>
                {{ $tahun }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Iuran per bulan:</strong>
                Rp25.000
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 55px">No.</th>
                        <th>Bulan</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Status</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bulanList as $nomor => $namaBulan)
                        @php
                            $item = $transaksi->get($nomor);
                            $lunas = $item && $item->status === 'lunas';
                        @endphp

                        <tr>
                            <td>{{ $nomor }}</td>
                            <td>{{ $namaBulan }}</td>

                            <td>
                                @if($lunas)
                                    {{ $item->tanggal_iuran->format('d-m-Y') }}
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                @if($lunas)
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Belum Bayar
                                    </span>
                                @endif
                            </td>

                            <td class="no-print">
                                @if($lunas)
                                    <form method="POST"
                                          action="{{ route('admin.iuran.batal-bayar', $warga->id) }}"
                                          onsubmit="return confirm('Batalkan catatan pembayaran bulan {{ $namaBulan }}?')">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" name="bulan"
                                               value="{{ $nomor }}">
                                        <input type="hidden" name="tahun"
                                               value="{{ $tahun }}">

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            Batalkan
                                        </button>
                                    </form>
                                @else
                                    <form method="POST"
                                          action="{{ route('admin.iuran.bayar', $warga->id) }}">
                                        @csrf

                                        <input type="hidden" name="bulan"
                                               value="{{ $nomor }}">
                                        <input type="hidden" name="tahun"
                                               value="{{ $tahun }}">

                                        <input type="hidden" name="tanggal_iuran"
                                               value="{{ now()->toDateString() }}">

                                        <button type="submit"
                                                class="btn btn-sm btn-success">
                                            Catat Lunas
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <div class="text-muted">Bulan Lunas</div>
                    <h4 class="fw-bold">{{ $totalLunas }} / 12</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <div class="text-muted">Total Dibayar</div>
                    <h4 class="fw-bold">
                        Rp{{ number_format($totalDibayar, 0, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <div class="text-muted">Sisa Tagihan</div>
                    <h4 class="fw-bold">
                        Rp{{ number_format($sisaTagihan, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="row text-center mt-5 pt-3">
            <div class="col-6">
                <p>Mengetahui,</p>
                <p>Ketua RT</p>
                <br><br>
                <strong>(_____________________)</strong>
            </div>

            <div class="col-6">
                <p>Petugas Pembayaran,</p>
                <p>Bendahara</p>
                <br><br>
                <strong>(_____________________)</strong>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        body {
            background: #fff !important;
        }

        .no-print,
        nav,
        aside,
        header,
        footer {
            display: none !important;
        }

        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        .kartu-iuran {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            padding: 10px !important;
        }

        table {
            font-size: 11px;
        }

        .badge {
            border: 1px solid #888;
            color: #000 !important;
            background: #fff !important;
        }
    }
</style>
@endsection
