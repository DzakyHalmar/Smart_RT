
@extends('layouts.app')

@section('title', 'Keluhan Warga')

@section('content')
<style>
    .complaint-page {
        max-width: 850px;
        padding: 48px 0 64px;
    }

    .complaint-heading h1 {
        margin: 8px 0;
        color: #183b32;
    }

    .complaint-heading p,
    .complaint-list-heading p {
        color: #718078;
        line-height: 1.7;
    }

    .complaint-panel {
        background: #fff;
        border: 1px solid #e5ece7;
        border-radius: 16px;
        padding: 26px;
        margin-top: 24px;
        box-shadow: 0 6px 22px rgba(25, 65, 48, .045);
    }

    .complaint-form label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #30483c;
    }

    .complaint-form input,
    .complaint-form select,
    .complaint-form textarea {
        display: block;
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        margin-bottom: 20px;
        border: 1px solid #dce5df;
        border-radius: 9px;
        background: #fff;
        color: #263b31;
        font: inherit;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .complaint-form input:focus,
    .complaint-form select:focus,
    .complaint-form textarea:focus {
        border-color: #168568;
        box-shadow: 0 0 0 3px rgba(22, 133, 104, .10);
    }

    .complaint-form textarea {
        min-height: 140px;
        resize: vertical;
    }

    .complaint-submit {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border: 0;
        border-radius: 9px;
        background: #176b55;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .complaint-submit:hover {
        background: #105440;
        color: #fff;
        transform: translateY(-1px);
    }

    .complaint-alert {
        padding: 14px 17px;
        border-radius: 10px;
        margin-top: 20px;
        line-height: 1.6;
    }

    .complaint-alert.success {
        background: #e7f7ee;
        color: #176b45;
        border: 1px solid #c9ead6;
    }

    .complaint-alert.error {
        background: #fff0ef;
        color: #b42318;
        border: 1px solid #f4d0cd;
    }

    .complaint-list-heading {
        margin-top: 42px;
    }

    .complaint-list-heading h2 {
        margin: 8px 0;
        color: #183b32;
    }

    .complaint-list {
        display: grid;
        gap: 16px;
        margin-top: 22px;
    }

    .complaint-card {
        background: #fff;
        border: 1px solid #e5ece7;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 5px 18px rgba(25, 65, 48, .04);
        transition: transform .2s, box-shadow .2s;
    }

    .complaint-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 24px rgba(25, 65, 48, .075);
    }

    .complaint-card-top {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .complaint-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #e8f6ef;
        color: #168568;
        font-size: 21px;
    }

    .complaint-content {
        flex: 1;
        min-width: 0;
    }

    .complaint-title {
        margin: 2px 0 8px;
        color: #183b32;
        font-size: 17px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .complaint-description {
        margin: 0;
        color: #64746b;
        font-size: 14px;
        line-height: 1.75;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .complaint-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .complaint-status.waiting {
        background: #fff3d6;
        color: #946200;
    }

    .complaint-status.processing {
        background: #e3efff;
        color: #2459a6;
    }

    .complaint-status.done {
        background: #dcf7e7;
        color: #187044;
    }

    .complaint-footer {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 18px;
        padding-top: 14px;
        border-top: 1px solid #edf1ee;
        color: #819087;
        font-size: 12px;
    }

    .complaint-empty {
        text-align: center;
        padding: 34px 20px;
        color: #718078;
    }

    .complaint-empty i {
        display: block;
        margin-bottom: 12px;
        color: #168568;
        font-size: 36px;
    }

    @media (max-width: 600px) {
        .complaint-page {
            padding: 30px 14px 48px;
        }

        .complaint-panel {
            padding: 19px;
        }

        .complaint-card {
            padding: 17px;
        }

        .complaint-card-top {
            flex-wrap: wrap;
            gap: 11px;
        }

        .complaint-icon {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
        }

        .complaint-content {
            flex-basis: calc(100% - 56px);
        }

        .complaint-status {
            margin-left: 53px;
        }

        .complaint-submit {
            width: 100%;
        }
    }
</style>

<section class="container complaint-page">

    {{-- Header --}}
    <div class="complaint-heading">
        <span class="section-kicker">LAYANAN WARGA</span>
        <h1>Kirim Keluhan</h1>
        <p>
            Sampaikan keluhan atau laporan mengenai lingkungan
            RT kepada pengurus agar dapat ditindaklanjuti.
        </p>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="complaint-alert success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi validasi --}}
    @if ($errors->any())
        <div class="complaint-alert error">
            <strong>Periksa kembali data kamu:</strong>
            <ul style="margin: 8px 0 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulir keluhan --}}
    <div class="complaint-panel">
        <form
            action="{{ route('keluhan.store') }}"
            method="POST"
            class="complaint-form"
        >
            @csrf

            <label for="nama">Nama Pelapor</label>
            <input
                type="text"
                id="nama"
                name="nama"
                value="{{ old('nama') }}"
                maxlength="255"
                placeholder="Masukkan nama kamu"
                required
            >

            <label for="kategori">Kategori Keluhan</label>
            <select id="kategori" name="kategori" required>
                <option value="">Pilih kategori keluhan</option>

                @foreach ([
                    'Kebersihan',
                    'Keamanan',
                    'Fasilitas Umum',
                    'Iuran',
                    'Ketertiban',
                    'Lainnya'
                ] as $kategori)
                    <option
                        value="{{ $kategori }}"
                        @selected(old('kategori') === $kategori)
                    >
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>

            <label for="judul">Judul Keluhan</label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul') }}"
                maxlength="255"
                placeholder="Contoh: Sampah menumpuk"
                required
            >

            <label for="isi">Detail Keluhan</label>
            <textarea
                id="isi"
                name="isi"
                placeholder="Jelaskan keluhan kamu secara jelas..."
                required
            >{{ old('isi') }}</textarea>

            <button type="submit" class="complaint-submit">
                <i class="bi bi-send-fill"></i>
                Kirim Keluhan
            </button>
        </form>
    </div>

    {{-- Daftar keluhan --}}
    <div class="complaint-list-heading">
        <span class="section-kicker">PEMANTAUAN LAPORAN</span>
        <h2>Daftar Keluhan Warga</h2>
        <p>
            Lihat status penanganan keluhan yang telah dikirim.
        </p>
    </div>

    <div class="complaint-list">
        @forelse ($keluhan as $item)
            @php
                $statusClass = match ($item->status) {
                    'Menunggu' => 'waiting',
                    'Diproses' => 'processing',
                    'Selesai' => 'done',
                    default => 'waiting',
                };

                $icon = match ($item->kategori) {
                    'Kebersihan' => 'bi-trash3',
                    'Keamanan' => 'bi-shield-check',
                    'Fasilitas Umum' => 'bi-tools',
                    'Iuran' => 'bi-wallet2',
                    'Ketertiban' => 'bi-people',
                    default => 'bi-chat-left-text',
                };
            @endphp

            <article class="complaint-card">
                <div class="complaint-card-top">
                    <div class="complaint-icon">
                        <i class="bi {{ $icon }}"></i>
                    </div>

                    <div class="complaint-content">
                        <h3 class="complaint-title">
                            {{ $item->judul }}
                        </h3>

                        <p class="complaint-description">{{ $item->isi }}</p>
                    </div>

                    <span class="complaint-status {{ $statusClass }}">
                        <i class="bi bi-circle-fill" style="font-size: 7px;"></i>
                        {{ $item->status }}
                    </span>
                </div>

                <div class="complaint-footer">
                    <i class="bi bi-calendar3"></i>
                    Dikirim {{ $item->created_at->format('d-m-Y') }}
                </div>
            </article>
        @empty
            <div class="complaint-card complaint-empty">
                <i class="bi bi-inbox"></i>
                <h3 style="color: #183b32; margin: 0 0 8px;">
                    Belum Ada Keluhan
                </h3>
                <p style="margin: 0;">
                    Keluhan yang dikirim akan muncul di sini.
                </p>
            </div>
        @endforelse
    </div>

</section>
@endsection
