<style>
    .terms-section {
        background: #101720;
        padding: 80px 0 100px 0;
        position: relative;
    }

    .terms-section-title {
        font-size: 1.7rem;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: -0.3px;
    }

    .step-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 28px 22px;
        position: relative;
        height: 100%;
    }

    .step-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: rgba(152, 135, 128, 0.18);
        position: absolute;
        top: 16px;
        right: 18px;
        line-height: 1;
    }

    .step-title {
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .step-desc {
        color: #8c9ba9;
        font-size: 0.8rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .requirement-box {
        margin-top: 40px;
        padding: 32px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px dashed rgba(152, 135, 128, 0.25);
    }

    .requirement-list li {
        color: #a0acb9;
        font-size: 0.82rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .requirement-list i {
        color: var(--color-terracotta);
        font-size: 0.9rem;
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .terms-section { padding: 60px 0 80px 0; }
        .terms-section-title { font-size: 1.45rem; }
        .requirement-box { padding: 24px; }
    }

    @media (max-width: 767px) {
        .terms-section { padding: 50px 0 70px 0; }
        .terms-section-title { font-size: 1.3rem; }
        .requirement-box { padding: 20px; margin-top: 30px; }
        .requirement-list li { font-size: 0.78rem; }
    }
</style>

<section class="terms-section">
    <div class="container position-relative" style="z-index: 2;">
        
        <div class="text-center mb-4">
            <span class="service-badge mb-2">Prosedur Praktis</span>
            <h2 class="terms-section-title mt-1">4 Langkah Mudah Pengajuan</h2>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="step-card">
                    <span class="step-number">01</span>
                    <div class="step-title">Isi Formulir</div>
                    <p class="step-desc">Masuk ke akun internal SIKOPI dan isi nominal pinjaman pada menu Pengajuan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="step-card">
                    <span class="step-number">02</span>
                    <div class="step-title">Verifikasi</div>
                    <p class="step-desc">Pengurus mengecek kelayakan serta histori simpanan anggota secara sistematis.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="step-card">
                    <span class="step-number">03</span>
                    <div class="step-title">Persetujuan</div>
                    <p class="step-desc">Notifikasi penerimaan akan dikirimkan otomatis melalui sistem dashboard.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="step-card">
                    <span class="step-number">04</span>
                    <div class="step-title">Pencairan</div>
                    <p class="step-desc">Dana ditransfer langsung ke rekening terdaftar dalam kurun 1x24 jam kerja.</p>
                </div>
            </div>
        </div>

        <div class="requirement-box">
            <div class="row align-items-center">
                <div class="col-lg-4 col-12 mb-3 mb-lg-0">
                    <h5 class="text-white fw-bold mb-1" style="font-size: 1.05rem;">Syarat & Ketentuan Umum</h5>
                    <p class="text-secondary mb-0" style="font-size: 0.78rem;">Memastikan keamanan transaksi bagi seluruh anggota koperasi.</p>
                </div>
                <div class="col-lg-8 col-12">
                    <ul class="list-unstyled requirement-list row mb-0">
                        <div class="col-md-6 col-12">
                            <li><i class="bi bi-check-circle-fill"></i> Terdaftar aktif sebagai Anggota minimal 6 bulan.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Mengunggah kelengkapan Slip Gaji bulan terakhir.</li>
                        </div>
                        <div class="col-md-6 col-12">
                            <li><i class="bi bi-check-circle-fill"></i> Sisa gaji mencukupi untuk skema potong gaji.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Tidak memiliki tunggakan pinjaman bermasalah.</li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>