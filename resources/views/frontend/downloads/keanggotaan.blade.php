@extends('frontend.layouts.index')

@section('title', 'Formulir Keanggotaan Baru - SIKOPI')

@section('content')
<style>
    :root {
        --color-primary: #1a232d;
        --color-accent-gold: #988780;
        --color-bg-light: #f4f6f8;
        --color-terracotta: #8f6152;
        --color-border: #e2e8f0;
        --color-charcoal: #334155;
    }

    /* Hero Section - Tinggi 75vh & Flexbox Center Alignment */
    .download-hero {
        background: linear-gradient(135deg, var(--color-primary) 0%, #0d131a 100%);
        min-height: 75vh;
        display: flex;
        align-items: center;
        padding: 120px 0 60px 0;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .download-hero-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 650px;
        height: 650px;
        background: radial-gradient(circle, rgba(152, 135, 128, 0.16) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .download-badge {
        background: rgba(152, 135, 128, 0.18);
        border: 1px solid rgba(152, 135, 128, 0.35);
        color: #d1c7c2;
        padding: 6px 18px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .download-content-section {
        background-color: var(--color-bg-light);
        padding: 80px 0 100px 0;
    }

    .document-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--color-border);
        box-shadow: 0 10px 30px rgba(26, 35, 45, 0.04);
        overflow: hidden;
    }

    .table-custom {
        margin-bottom: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead {
        background-color: #f8fafc;
    }

    .table-custom thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 800;
        color: #64748b;
        padding: 18px 24px;
        border-bottom: 1px solid var(--color-border);
        white-space: nowrap;
    }

    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }

    .table-custom tbody td {
        padding: 22px 24px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
        color: var(--color-charcoal);
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .doc-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .doc-icon-pdf { background: rgba(220, 38, 38, 0.1); color: #dc2626; }
    .doc-icon-docx { background: rgba(37, 99, 235, 0.1); color: #2563eb; }

    .file-badge {
        font-size: 0.78rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pdf { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .badge-docx { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }

    .btn-download-action {
        background-color: var(--color-primary);
        color: #ffffff;
        font-size: 0.9rem;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-download-action:hover {
        background-color: var(--color-terracotta);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(143, 97, 82, 0.3);
    }

    .feature-info-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid var(--color-border);
        padding: 28px;
        height: 100%;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.02);
    }

    .info-icon-box {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: rgba(143, 97, 82, 0.12);
        color: var(--color-terracotta);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }
</style>

<!-- Hero Section Dibuat Rata Tengah & Tinggi 75vh -->
<section class="download-hero">
    <div class="download-hero-glow"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9 col-12">
                <span class="download-badge mb-3">
                    <i class="bi bi-person-plus-fill"></i> Unduh Dokumen
                </span>
                <h1 class="fw-extrabold text-white mb-3" style="font-size: 2.8rem; letter-spacing: -0.5px; font-weight: 800; line-height: 1.25;">
                    Formulir Keanggotaan Baru
                </h1>
                <p class="text-white-50 mb-0" style="font-size: 1.1rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">
                    Unduh kelengkapan berkas resmi pendaftaran keanggotaan baru Koperasi SIKOPI Inspektorat Kota Yogyakarta beserta lembar konfirmasi komitmen simpanan wajib.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="download-content-section">
    <div class="container">
        
        <!-- Tabel Dokumen Utama -->
        <div class="document-card mb-5">
            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">NO</th>
                            <th>NAMA DOKUMEN & DESKRIPSI</th>
                            <th class="text-center" style="width: 130px;">FORMAT</th>
                            <th class="text-center" style="width: 120px;">UKURAN</th>
                            <th class="text-center" style="width: 150px;">TGL UPDATE</th>
                            <th class="text-end" style="width: 170px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center fw-bold text-muted" style="font-size: 1rem;">01</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="doc-icon-box doc-icon-pdf">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Formulir Pendaftaran Anggota Baru SIKOPI</div>
                                        <div class="text-secondary" style="font-size: 0.88rem; line-height: 1.5;">Isi biodata diri lengkap, NIP/ID Pegawai, serta pilihan skema simpanan awal keanggotaan.</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span class="file-badge badge-pdf">PDF</span></td>
                            <td class="text-center fw-bold text-secondary" style="font-size: 0.9rem;">245 KB</td>
                            <td class="text-center text-muted" style="font-size: 0.88rem;">10 Jan 2026</td>
                            <td class="text-end">
                                <a href="#" class="btn-download-action"><i class="bi bi-download"></i> Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold text-muted" style="font-size: 1rem;">02</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="doc-icon-box doc-icon-docx">
                                        <i class="bi bi-file-earmark-word-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Surat Pernyataan Persetujuan AD/ART Koperasi</div>
                                        <div class="text-secondary" style="font-size: 0.88rem; line-height: 1.5;">Lembar persetujuan resmi kewajiban mematuhi Anggaran Dasar & Anggaran Rumah Tangga SIKOPI.</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span class="file-badge badge-docx">DOCX</span></td>
                            <td class="text-center fw-bold text-secondary" style="font-size: 0.9rem;">118 KB</td>
                            <td class="text-center text-muted" style="font-size: 0.88rem;">12 Jan 2026</td>
                            <td class="text-end">
                                <a href="#" class="btn-download-action"><i class="bi bi-download"></i> Unduh</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section Penunjang Biar Gak Kosong -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-info-card">
                    <div class="info-icon-box mb-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h3 style="color: var(--color-primary); font-weight: 700; font-size: 1.25rem;" class="mb-2"> Pengisian Berkas</h3>
                    <p style="color: var(--color-charcoal); font-size: 0.95rem; line-height: 1.6; margin-bottom: 0;">
                        Isi formulir secara lengkap menggunakan cetak cetak fisik atau ketik langsung pada template Word yang telah disiapkan.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-info-card">
                    <div class="info-icon-box mb-3">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <h3 style="color: var(--color-primary); font-weight: 700; font-size: 1.25rem;" class="mb-2"> Kelengkapan Lampiran</h3>
                    <p style="color: var(--color-charcoal); font-size: 0.95rem; line-height: 1.6; margin-bottom: 0;">
                        Lampirkan fotokopi KTP aktif dan Kartu Identitas Pegawai (ID Card Inspektorat) bersama lembar formulir pendaftaran.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="feature-info-card">
                    <div class="info-icon-box mb-3">
                        <i class="bi bi-send-check"></i>
                    </div>
                    <h3 style="color: var(--color-primary); font-weight: 700; font-size: 1.25rem;" class="mb-2"> Penyerahan Berkas</h3>
                    <p style="color: var(--color-charcoal); font-size: 0.95rem; line-height: 1.6; margin-bottom: 0;">
                        Serahkan dokumen ke Sekretariat Pengurus Koperasi SIKOPI untuk proses verifikasi dan pembuatan nomor ID Anggota.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection