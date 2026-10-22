
@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<section class="container" style="padding: 48px 0 64px;">
    <span class="section-kicker">INFORMASI LINGKUNGAN</span>
    <h1>Pengumuman Warga</h1>
    <p>
        Informasi terbaru mengenai kegiatan dan agenda
        lingkungan RT 005 / RW 003.
    </p>

    @forelse ($pengumuman as $item)
        <div class="panel" style="margin-top: 16px;">
            <div class="announcement">
                <div class="announcement-icon">
                    <i class="bi bi-megaphone"></i>
                </div>

                <div class="announcement-copy">
                    <strong>{{ $item->judul }}</strong>

                    <span>
                        {{ $item->tanggal->translatedFormat('d F Y') }}
                    </span>

                    <p>{{ $item->isi }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="panel" style="margin-top: 28px; padding: 24px;">
            <p>Belum ada pengumuman yang diterbitkan.</p>
        </div>
    @endforelse
</section>
@endsection
