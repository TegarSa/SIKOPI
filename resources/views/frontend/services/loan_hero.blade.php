<style>
    :root {
        --color-primary: #1a232d;
        --color-accent-gold: #988780;
        --color-bg-light: #e7ded9;
        --color-terracotta: #8f6152;
    }

    .service-hero-wrapper {
        background: linear-gradient(135deg, var(--color-primary) 0%, #0d131a 100%);
        position: relative;
        padding: 190px 0 100px 0;
        min-height: 85vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .service-hero-glow {
        position: absolute;
        top: -10%;
        left: 50%;
        transform: translateX(-50%);
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(143, 97, 82, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .service-badge {
        background: rgba(152, 135, 128, 0.12);
        border: 1px solid rgba(152, 135, 128, 0.25);
        color: var(--color-accent-gold);
        padding: 6px 16px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .service-title {
        color: #ffffff;
        font-weight: 700;
        font-size: 2.2rem;
        letter-spacing: -0.5px;
        line-height: 1.3;
    }

    .service-title .highlight {
        color: transparent;
        background: linear-gradient(135deg, var(--color-accent-gold) 0%, var(--color-bg-light) 100%);
        -webkit-background-clip: text;
        background-clip: text;
    }

    .service-desc {
        color: #9aa7b5;
        font-size: 0.92rem;
        line-height: 1.7;
        max-width: 680px;
        margin: 0 auto;
    }

    .feature-pill-card {
        background: rgba(255, 255, 255, 0.025);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 26px;
        backdrop-filter: blur(10px);
        transition: transform 0.2s ease, border-color 0.2s ease;
        height: 100%;
    }

    .feature-pill-card:hover {
        border-color: rgba(143, 97, 82, 0.35);
        transform: translateY(-3px);
    }

    .feature-icon {
        width: 38px;
        height: 38px;
        background: rgba(143, 97, 82, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-terracotta);
        font-size: 1.1rem;
        margin-bottom: 16px;
    }

    .feature-title {
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .feature-text {
        color: #8c9ba9;
        font-size: 0.82rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .service-hero-wrapper {
            padding: 160px 0 80px 0;
            min-height: auto;
        }
        .service-title { font-size: 1.9rem; }
        .service-desc { font-size: 0.88rem; }
        .feature-pill-card { padding: 22px; }
    }

    @media (max-width: 767px) {
        .service-hero-wrapper {
            padding: 140px 0 60px 0;
            min-height: auto;
        }
        .service-title { font-size: 1.55rem; }
        .service-desc { font-size: 0.83rem; }
        .feature-pill-card { padding: 18px; }
    }
</style>

<section class="service-hero-wrapper text-center">
    <div class="service-hero-glow"></div>
    <div class="container position-relative" style="z-index: 2;">
        
        <div class="mb-3">
            <span class="service-badge">
                <i class="bi bi-wallet2"></i> Layanan Keuangan Internal
            </span>
        </div>

        <h1 class="service-title mb-3">
            Pengajuan <span class="highlight">Pinjaman Anggota</span>
        </h1>

        <p class="service-desc mb-5">
            Solusi pembiayaan internal yang transparan, aman, dan dirancang khusus untuk memenuhi kebutuhan mendesak maupun perencanaan masa depan seluruh anggota Koperasi Internal.
        </p>

        <div class="row g-4 text-start mt-2">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-pill-card">
                    <div class="feature-icon"><i class="bi bi-percent"></i></div>
                    <div class="feature-title">Bunga Internal Ringan</div>
                    <p class="feature-text">Perhitungan margin/bunga yang dikembalikan dalam bentuk SHU untuk kesejahteraan bersama.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-pill-card">
                    <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
                    <div class="feature-title">Proses Cepat & Digital</div>
                    <p class="feature-text">Pengajuan tanpa kertas (paperless), langsung diverifikasi oleh pengurus secara otomatis.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <div class="feature-pill-card">
                    <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="feature-title">Potong Gaji Otomatis</div>
                    <p class="feature-text">Sistem angsuran terintegrasi dengan penggajian bulanan tanpa ribet melakukan transfer manual.</p>
                </div>
            </div>
        </div>

    </div>
</section>