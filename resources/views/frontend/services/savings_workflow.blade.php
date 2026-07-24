<style>
    .workflow-section {
        background: #101720;
        padding: 80px 0 100px 0;
        position: relative;
    }

    .workflow-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 26px 20px;
        position: relative;
        height: 100%;
    }

    .workflow-step {
        width: 32px;
        height: 32px;
        background: rgba(152, 135, 128, 0.15);
        color: var(--color-accent-gold);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 16px;
    }

    .workflow-title {
        color: #ffffff;
        font-size: 0.92rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .workflow-desc {
        color: #8c9ba9;
        font-size: 0.78rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .faq-mini-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 20px;
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .workflow-section { padding: 60px 0 80px 0; }
    }

    @media (max-width: 767px) {
        .workflow-section { padding: 50px 0 70px 0; }
    }
</style>

<section class="workflow-section">
    <div class="container position-relative" style="z-index: 2;">
        
        <div class="text-center mb-5">
            <span class="savings-badge mb-2">Transparansi Operasional</span>
            <h2 class="text-white fw-bold mt-1" style="font-size: 1.6rem; letter-spacing: -0.3px;">Cara Kerja Simpanan Anggota</h2>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="workflow-card">
                    <div class="workflow-step">1</div>
                    <div class="workflow-title">Otorisasi Potong Gaji</div>
                    <p class="workflow-desc">Anggota menyetujui besaran simpanan sukarela melalui formulir digital di sistem SIKOPI.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="workflow-card">
                    <div class="workflow-step">2</div>
                    <div class="workflow-title">Pencatatan Otomatis</div>
                    <p class="workflow-desc">Setiap tanggal penggajian, dana simpanan langsung terbukukan ke buku tabungan digital.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="workflow-card">
                    <div class="workflow-step">3</div>
                    <div class="workflow-title">Pengelolaan Usaha</div>
                    <p class="workflow-desc">Dana dikelola pada unit pembiayaan produktif yang minim risiko untuk menghasilkan margin.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="workflow-card">
                    <div class="workflow-step">4</div>
                    <div class="workflow-title">Pencairan & Dividen</div>
                    <p class="workflow-desc">SHU dibagikan tahunan dan simpanan sukarela dapat ditarik sewaktu-waktu sesuai ketentuan.</p>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6 col-12">
                <div class="faq-mini-card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-question-circle text-warning" style="font-size: 1rem;"></i>
                        <h6 class="text-white mb-0" style="font-size: 0.88rem;">Bisakah Simpanan Sukarela Ditarik Sewaktu-waktu?</h6>
                    </div>
                    <p class="text-secondary mb-0" style="font-size: 0.78rem; line-height: 1.6;">Ya, simpanan sukarela dapat ditarik kapan saja melalui menu penarikan pada dashboard anggota dengan waktu pemrosesan 1x24 jam.</p>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="faq-mini-card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-shield-check text-success" style="font-size: 1rem;"></i>
                        <h6 class="text-white mb-0" style="font-size: 0.88rem;">Bagaimana Ketentuan Penarikan Simpanan Pokok?</h6>
                    </div>
                    <p class="text-secondary mb-0" style="font-size: 0.78rem; line-height: 1.6;">Simpanan Pokok dan Wajib hanya dapat ditarik apabila anggota secara resmi mengundurkan diri dari keanggotaan Koperasi.</p>
                </div>
            </div>
        </div>

    </div>
</section>