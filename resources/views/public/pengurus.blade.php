@extends('layouts.app')

@section('title', 'Pengurus RT')

@section('content')
<section class="container" style="padding: 48px 0 64px;">
    <span class="section-kicker">KENALI LINGKUNGAN</span>
    <h1>Struktur Pengurus RT</h1>
    <p>
        Pengurus RT berperan dalam melayani warga dan menjaga
        lingkungan agar tetap aman, tertib, dan nyaman.
    </p>

    <div class="dashboard-grid" style="margin-top: 28px;">
        @forelse ($pengurus as $orang)
            <article class="panel">
                <div class="avatar">{{ $orang->inisial }}</div>
                <p class="official-role">{{ $orang->jabatan }}</p>
                <h3>{{ $orang->nama }}</h3>

                @if ($orang->no_telepon)
                    <p>
                        <i class="bi bi-telephone"></i>
                        {{ $orang->no_telepon }}
                    </p>
                @endif

                @if ($orang->alamat)
                    <p>
                        <i class="bi bi-geo-alt"></i>
                        {{ $orang->alamat }}
                    </p>
                @endif
            </article>
        @empty
            <div class="panel">
                <h3>Data pengurus belum tersedia</h3>
                <p>
                    Informasi pengurus akan ditampilkan setelah
                    admin menambahkan data pengurus.
                </p>
            </div>
        @endforelse
    </div>
</section>
@endsection