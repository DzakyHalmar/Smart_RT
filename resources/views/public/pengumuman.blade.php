
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

    <div class="panel" style="margin-top: 28px;">
        <div class="announcement">
            <div class="announcement-icon">
                <i class="bi bi-megaphone"></i>
            </div>
            <div class="announcement-copy">
                <strong>Kerja Bakti Lingkungan</strong>
                <span>12 Oktober 2026</span>
                <p>Mari bersama menjaga kebersihan dan kenyamanan lingkungan.</p>
            </div>
        </div>
    </div>

    <div class="panel" style="margin-top: 16px;">
        <div class="announcement">
            <div class="announcement-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="announcement-copy">
                <strong>Pembayaran Iuran Bulanan</strong>
                <span>Batas pembayaran 31 Oktober 2026</span>
                <p>Warga diimbau membayar iuran bulanan sesuai ketentuan RT.</p>
            </div>
        </div>
    </div>

    <div class="panel" style="margin-top: 16px;">
        <div class="announcement">
            <div class="announcement-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="announcement-copy">
                <strong>Rapat Warga</strong>
                <span>Bulan November 2026</span>
                <p>Informasi waktu dan tempat rapat akan disampaikan oleh pengurus.</p>
            </div>
        </div>
    </div>
</section>
@endsection
