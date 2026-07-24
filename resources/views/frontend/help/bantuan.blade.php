@extends('frontend.layouts.index')

@section('title', 'Pusat Bantuan & FAQ - SIKOPI')

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

    .help-hero {
        background: linear-gradient(135deg, var(--color-primary) 0%, #0d131a 100%);
        min-height: 85vh;
        display: flex;
        align-items: center;
        padding: 120px 0 60px 0;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .help-hero-glow {
        position: absolute;
        top: -10%;
        right: -10%;
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(152, 135, 128, 0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .help-badge {
        background: rgba(152, 135, 128, 0.18);
        border: 1px solid rgba(152, 135, 128, 0.35);
        color: #d1c7c2;
        padding: 6px 16px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    /* Glassmorphism Preview Card */
    .hero-card-preview {
        background: rgba(255, 255, 255, 0.04);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .hero-card-preview::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--color-accent-gold), transparent);
    }

    /* Badge Jam Kerja Senada Tema */
    .work-hours-badge {
        background: rgba(152, 135, 128, 0.22);
        border: 1px solid rgba(152, 135, 128, 0.4);
        color: #e2d9d5;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        transition: transform 0.2s ease;
    }

    .contact-item:hover {
        transform: translateX(4px);
        background: rgba(255, 255, 255, 0.06);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(152, 135, 128, 0.2);
        color: #e2d9d5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    /* Content Section */
    .help-content-section {
        background-color: var(--color-bg-light);
        padding: 80px 0 100px 0;
    }

    .accordion-custom .accordion-item {
        background: #ffffff;
        border: 1px solid var(--color-border);
        border-radius: 14px !important;
        margin-bottom: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.02);
    }

    .accordion-custom .accordion-button {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--color-primary);
        padding: 22px 28px;
        background: #ffffff;
        box-shadow: none;
    }

    .accordion-custom .accordion-button:not(.collapsed) {
        color: var(--color-terracotta);
        background-color: #f8fafc;
        border-bottom: 1px solid var(--color-border);
    }

    .accordion-custom .accordion-body {
        padding: 24px 28px;
        color: var(--color-charcoal);
        font-size: 0.98rem;
        line-height: 1.7;
    }

    .support-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--color-border);
        padding: 32px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.02);
        height: 100%;
        transition: transform 0.2s ease;
    }

    .support-card:hover {
        transform: translateY(-4px);
    }

    .support-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        background: rgba(143, 97, 82, 0.12);
        color: var(--color-terracotta);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 20px auto;
    }

    .btn-help-cta {
        background: linear-gradient(135deg, var(--color-terracotta) 0%, #754c3e 100%);
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 700;
        padding: 12px 26px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 20px rgba(143, 97, 82, 0.3);
        transition: all 0.2s ease;
        border: none;
    }

    .btn-help-cta:hover {
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(143, 97, 82, 0.45);
    }
</style>

<!-- Hero Section (Tinggi Min 85vh) -->
<section class="help-hero">
    <div class="help-hero-glow"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <!-- Kolom Teks Kiri -->
            <div class="col-lg-7 col-12">
                <span class="help-badge mb-3">
                    <i class="bi bi-question-circle-fill"></i> Pusat Bantuan
                </span>
                <h1 class="fw-extrabold text-white mb-3" style="font-size: 2.8rem; letter-spacing: -0.5px; font-weight: 800; line-height: 1.25;">
                    Ada yang Bisa Kami Bantu? <br><span style="color: #d1c7c2; font-weight: 400;">Layanan Bantuan SIKOPI</span>
                </h1>
                <p class="text-white-50 mb-4" style="font-size: 1.1rem; max-width: 620px; line-height: 1.7;">
                    Temukan panduan penggunaan, jawaban atas pertanyaan umum (FAQ), atau hubungi Tim Pengurus Koperasi SIKOPI Inspektorat Kota Yogyakarta.
                </p>
                
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <a href="#faq-section" class="btn-help-cta">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Pertanyaan Umum
                    </a>
                    <span class="text-white-50" style="font-size: 0.9rem;">
                        <i class="bi bi-clock-history text-warning me-1"></i> Respon Cepat Layanan
                    </span>
                </div>
            </div>

            <!-- Visual Showcase Kanan -->
            <div class="col-lg-5 col-12">
                <div class="hero-card-preview">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                        <span class="text-white fw-bold" style="font-size: 0.95rem;">
                            <i class="bi bi-headset me-1 text-warning"></i> Kontak Langsung Pengurus
                        </span>
                        <span class="work-hours-badge">
                            <i class="bi bi-clock me-1"></i> 08.00 - 15.30 WIB
                        </span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <div class="text-white fw-semibold" style="font-size: 0.9rem;">Email Dukungan</div>
                                <div class="text-white-50" style="font-size: 0.8rem;">sikopi.support@gmail.com</div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <div class="text-white fw-semibold" style="font-size: 0.9rem;">WhatsApp Pengurus</div>
                                <div class="text-white-50" style="font-size: 0.8rem;">+62 812-3456-7890</div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div>
                                <div class="text-white fw-semibold" style="font-size: 0.9rem;">Lokasi Kantor</div>
                                <div class="text-white-50" style="font-size: 0.8rem;">Gedung Inspektorat Kota Yogyakarta</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Content Section -->
<section class="help-content-section" id="faq-section">
    <div class="container">
        
        <!-- FAQ Title -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <span class="help-badge mb-2" style="background: rgba(143, 97, 82, 0.12); color: var(--color-terracotta); border: 1px solid rgba(143, 97, 82, 0.25);">
                    Jawaban Cepat
                </span>
                <h2 style="color: var(--color-primary); font-weight: 800; font-size: 2rem;" class="mb-0">
                    Pertanyaan Sering Diajukan (FAQ)
                </h2>
            </div>
        </div>

        <!-- Accordion FAQ -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 col-12">
                <div class="accordion accordion-custom" id="faqAccordion">
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                Bagaimana cara mendaftar menjadi anggota baru Koperasi SIKOPI?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk menjadi anggota, Anda dapat mengunduh <strong>Formulir Keanggotaan Baru</strong> pada menu <em>Unduh Dokumen</em>. Isi formulir secara lengkap, lampirkan fotokopi KTP serta ID Card Pegawai Inspektorat, kemudian serahkan berkas fisik ke Sekretariat Pengurus SIKOPI.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                Berapa batas maksimal pemotongan gaji bulanan untuk angsuran pinjaman?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sesuai ketentuan yang berlaku, akumulasi total pemotongan gaji (simpanan + angsuran pinjaman) ditetapkan maksimal <strong>50% dari Take Home Pay (THP)</strong> bulanan pegawai guna menjaga stabilitas finansial anggota.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                Berapa lama proses pengajuan dan pencairan pembiayaan pinjaman?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Proses verifikasi berkas dan persetujuan pinjaman memerlukan waktu 1–2 hari kerja setelah dokumen diterima lengkap oleh Sekretariat. Setelah disetujui Ketua, pencairan dana akan ditransfer langsung oleh Bendahara ke rekening terdaftar Anda.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                Kapan dana simpanan dikembalikan jika anggota mengundurkan diri?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pengembalian akumulasi Simpanan Pokok dan Simpanan Wajib akan dikalkulasi menyeluruh (dikurangi sisa kewajiban pinjaman jika ada) dan ditransfer ke rekening pribadi anggota paling lambat 7 hari kerja setelah permohonan pengunduran diri disetujui.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3 Kartu Bantuan Tambahan -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="support-card">
                    <div class="support-icon-box">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                    </div>
                    <h3 style="color: var(--color-primary); font-weight: 700; font-size: 1.2rem;" class="mb-2">Unduh Formulir</h3>
                    <p style="color: var(--color-charcoal); font-size: 0.95rem; line-height: 1.6;" class="mb-0">
                        Butuh berkas fisik? Dapatkan formulir pendaftaran, surat kuasa, atau pengajuan pinjaman di menu unduhan.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="support-card">
                    <div class="support-icon-box">
                        <i class="bi bi-telephone-inbound"></i>
                    </div>
                    <h3 style="color: var(--color-primary); font-weight: 700; font-size: 1.2rem;" class="mb-2">Konsultasi Langsung</h3>
                    <p style="color: var(--color-charcoal); font-size: 0.95rem; line-height: 1.6;" class="mb-0">
                        Hubungi pengurus via WhatsApp atau telepon untuk pertanyaan khusus seputar simulasi pinjaman & saldo.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="support-card">
                    <div class="support-icon-box">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h3 style="color: var(--color-primary); font-weight: 700; font-size: 1.2rem;" class="mb-2">Layanan Tatap Muka</h3>
                    <p style="color: var(--color-charcoal); font-size: 0.95rem; line-height: 1.6;" class="mb-0">
                        Kunjungi Sekretariat Koperasi SIKOPI di lingkungan Kantor Inspektorat Kota Yogyakarta pada jam kerja operasional.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection