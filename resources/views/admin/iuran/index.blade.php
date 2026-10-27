@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-bold mb-1">Data Iuran Bulanan</h2>
            <p class="text-muted mb-0">
                Kelola pembayaran iuran warga RT 001/RW 012.
            </p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.transaksi-lain.index') }}"
            class="btn btn-outline-success">
                Lihat Transaksi Lain
            </a>

            <a href="{{ route('admin.iuran.create') }}"
            class="btn btn-success">
                + Tambah Transaksi Lain
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET"
                  action="{{ route('admin.iuran.index') }}"
                  class="row align-items-end g-3">

                <div class="col-md-4">
                    <label for="tahun" class="form-label fw-semibold">
                        Tahun Kartu Iuran
                    </label>

                    <select name="tahun" id="tahun" class="form-select">
                        @for($y = now()->year - 2; $y <= now()->year + 2; $y++)
                            <option value="{{ $y }}"
                                @selected($tahun == $y)>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Warga</th>
                            <th>NIK</th>
                            <th>Iuran Lunas</th>
                            <th>Total Dibayar</th>
                            <th>Sisa Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($warga as $index => $orang)
                            @php
                                $lunas = min((int) $orang->bulan_lunas, 12);
                                $dibayar = $lunas * 25000;
                                $sisa = (12 - $lunas) * 25000;
                            @endphp

                            <tr>
                                <td>
                                    {{ $warga->firstItem() + $index }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $orang->nama }}
                                </td>

                                <td>{{ $orang->nik }}</td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ $lunas }}/12 bulan
                                    </span>
                                </td>

                                <td>
                                    Rp{{ number_format($dibayar, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp{{ number_format($sisa, 0, ',', '.') }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.iuran.kartu', [
                                        'warga' => $orang->id,
                                        'tahun' => $tahun
                                    ]) }}"
                                       class="btn btn-sm btn-success">
                                        Buka Kartu
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    Belum ada data warga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $warga->links() }}
            </div>
        </div>
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
