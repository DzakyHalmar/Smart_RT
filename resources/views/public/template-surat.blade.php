
@extends('layouts.app')

@section('content')
<style>
    .template-surat-page {
        background: #f7f8f5;
        min-height: 80vh;
        padding: 55px 0;
    }

    .template-surat-container {
        width: min(1100px, 92%);
        margin: auto;
    }

    .template-surat-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .template-surat-heading h1 {
        color: #174b36;
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;
        margin-bottom: 12px;
    }

    .template-surat-heading p {
        color: #66736a;
        max-width: 650px;
        margin: auto;
        line-height: 1.7;
    }

    .template-surat-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .template-surat-card {
        background: white;
        border: 1px solid #e5ebe5;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(20, 60, 40, .05);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        transition: transform .2s, box-shadow .2s;
    }

    .template-surat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(20, 60, 40, .1);
    }

    .template-surat-icon {
        width: 55px;
        height: 55px;
        display: grid;
        place-items: center;
        border-radius: 15px;
        background: #eaf5ed;
        font-size: 27px;
        margin-bottom: 18px;
    }

    .template-surat-card h3 {
        color: #234b37;
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 10px;
    }

    .template-surat-card p {
        color: #68756c;
        line-height: 1.6;
        font-size: 14px;
        flex: 1;
    }

    .template-surat-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .template-surat-btn {
        display: inline-block;
        padding: 10px 14px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
    }

    .template-surat-preview {
        color: #24543a;
        background: #eaf5ed;
    }

    .template-surat-download {
        color: white;
        background: #26734d;
    }

    .template-surat-note {
        margin-top: 30px;
        padding: 18px;
        border-radius: 12px;
        background: #fff8e8;
        color: #775d24;
        line-height: 1.7;
        font-size: 14px;
    }

    @media (max-width: 850px) {
        .template-surat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 550px) {
        .template-surat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $templates = [
        [
            'judul' => 'Surat Pengantar RT/RW',
            'deskripsi' => 'Template surat pengantar untuk keperluan administrasi warga.',
            'ikon' => '📄',
            'file' => 'surat-pengantar-rt.pdf',
        ],
        [
            'judul' => 'Surat Keterangan Domisili',
            'deskripsi' => 'Template surat keterangan tempat tinggal.',
            'ikon' => '🏠',
            'file' => 'surat-domisili.pdf',
        ],
        [
            'judul' => 'Surat Keterangan Usaha',
            'deskripsi' => 'Template keterangan usaha milik warga.',
            'ikon' => '🏪',
            'file' => 'surat-keterangan-usaha.pdf',
        ],
        [
            'judul' => 'Surat Keterangan Tidak Mampu',
            'deskripsi' => 'Template untuk keperluan administrasi terkait keterangan tidak mampu.',
            'ikon' => '📋',
            'file' => 'surat-tidak-mampu.pdf',
        ],
        [
            'judul' => 'Surat Keterangan Kelahiran',
            'deskripsi' => 'Template keterangan terkait peristiwa kelahiran.',
            'ikon' => '👶',
            'file' => 'surat-keterangan-kelahiran.pdf',
        ],
        [
            'judul' => 'Surat Keterangan Kematian',
            'deskripsi' => 'Template keterangan terkait peristiwa kematian.',
            'ikon' => '🕊️',
            'file' => 'surat-keterangan-kematian.pdf',
        ],
    ];
@endphp

<div class="template-surat-page">
    <div class="template-surat-container">
        <div class="template-surat-heading">
            <h1>Template Surat</h1>
            <p>
                Temukan template surat administrasi untuk kebutuhan warga.
                Pilih dokumen untuk melihat atau mengunduhnya.
            </p>
        </div>

        <div class="template-surat-grid">
            @foreach ($templates as $template)
                <article class="template-surat-card">
                    <div class="template-surat-icon">
                        {{ $template['ikon'] }}
                    </div>

                    <h3>{{ $template['judul'] }}</h3>

                    <p>{{ $template['deskripsi'] }}</p>

                    <div class="template-surat-actions">
                        <a
                            href="{{ asset('pdf-surat/' . $template['file']) }}"
                            download
                            class="template-surat-btn template-surat-download"
                        >
                            Unduh PDF
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="template-surat-note">
            <strong>Informasi:</strong>
            Dokumen ini merupakan template. Sesuaikan isi, nomor surat,
            identitas, dan pengesahan dengan ketentuan RT/RW setempat.
        </div>
    </div>
</div>
@endsection
