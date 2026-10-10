
@extends('layouts.app')

@section('title', 'Pengurus RT')

@section('content')
<section class="container" style="padding: 48px 0 64px;">
    <span class="section-kicker">KENALI LINGKUNGAN</span>
    <h1>Struktur Pengurus RT 005</h1>
    <p>
        Pengurus RT berperan dalam melayani warga dan menjaga
        lingkungan agar tetap aman, tertib, dan nyaman.
    </p>

    <div class="dashboard-grid" style="margin-top: 28px;">
        <article class="panel">
            <div class="avatar">RS</div>
            <p class="official-role">Ketua RT</p>
            <h3>Ridi Santoso</h3>
        </article>

        <article class="panel">
            <div class="avatar">SR</div>
            <p class="official-role">Sekretaris</p>
            <h3>Siti Rahmawati</h3>
        </article>

        <article class="panel">
            <div class="avatar">AS</div>
            <p class="official-role">Bendahara</p>
            <h3>Agus Setiawan</h3>
        </article>
    </div>
</section>
@endsection
