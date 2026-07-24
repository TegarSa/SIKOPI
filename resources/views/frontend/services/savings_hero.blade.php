<style>
    :root {
        --color-primary: #1a232d;
        --color-accent-gold: #988780;
        --color-bg-light: #e7ded9;
        --color-terracotta: #8f6152;
    }

    .savings-hero-wrapper {
        background: linear-gradient(135deg, var(--color-primary) 0%, #0d131a 100%);
        position: relative;
        padding: 190px 0 90px 0;
        min-height: 80vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .savings-hero-glow {
        position: absolute;
        top: -10%;
        left: 50%;
        transform: translateX(-50%);
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(152, 135, 128, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .savings-badge {
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

    .savings-title {
        color: #ffffff;
        font-weight: 700;
        font-size: 2.2rem;
        letter-spacing: -0.5px;
        line-height: 1.3;
    }

    .savings-title .highlight {
        color: transparent;
        background: linear-gradient(135deg, var(--color-accent-gold) 0%, var(--color-bg-light) 100%);
        -webkit-background-clip: text;
        background-clip: text;
    }

    .savings-desc {
        color: #9aa7b5;
        font-size: 0.92rem;
        line-height: 1.7;
        max-width: 680px;
        margin: 0 auto;
    }

    .stat-card-compact {
        background: rgba(255, 255, 255, 0.025);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 22px 20px;
        backdrop-filter: blur(10px);
        transition: transform 0.2s ease, border-color 0.2s ease;
        height: 100%;
    }

    .stat-card-compact:hover {
        border-color: rgba(152, 135, 128, 0.35);
        transform: translateY(-3px);
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        background: rgba(152, 135, 128, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-accent-gold);
        font-size: 1.05rem;
        margin-bottom: 14px;
    }

    .stat-title {
        color: #ffffff;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .stat-text {
        color: #8c9ba9;
        font-size: 0.8rem;
        line-height: 1.5;
        margin-bottom: 0;
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .savings-hero-wrapper {
            padding: 160px 0 70px 0;
            min-height: auto;
        }
        .savings-title { font-size: 1.9rem; }
        .savings-desc { font-size: 0.88rem; }
    }

    @media (max-width: 767px) {
        .savings-hero-wrapper {
            padding: 140px 0 50px 0;
            min-height: auto;
        }
        .savings-title { font-size: 1.55rem; }
        .savings-desc { font-size: 0.83rem; }
        .stat-card-compact { padding: 18px; }
    }
</style>

<section class="savings-hero-wrapper text-center">
    <div class="savings-hero-glow"></div>
    <div class="container position-relative" style="z-index: 2;">
        
        <div class="mb-3">
            <span class="savings-badge">
                <i class="bi bi-piggy-bank"></i> Program Investasi Internal
            </span>
        </div>

        <h1 class="savings-title mb-3">
            Program <span class="highlight">Simpanan Anggota</span>
        </h1>

        <p class="savings-desc mb-5">
            Bangun ketahanan finansial bersama Koperasi Internal. Nikmati pembagian Sisa Hasil Usaha (SHU) yang adil, bagi hasil transparan, dan jaminan dana aman terintegrasi.
        </p>

        <div class="row g-3 text-start mt-2">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="stat-card-compact">
                    <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <div class="stat-title">Imbal Hasil SHU Tahunan</div>
                    <p class="stat-text">Alokasi keuntungan dari unit usaha yang dibagikan secara proporsional tiap akhir tahun.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="stat-card-compact">
                    <div class="stat-icon"><i class="bi bi-shield-lock"></i></div>
                    <div class="stat-title">Terjaga & Terverifikasi</div>
                    <p class="stat-text">Pengelolaan simpanan diawasi secara independen oleh audit internal dan pengurus koperasi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="stat-card-compact">
                    <div class="stat-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <div class="stat-title">Autodebet Fleksibel</div>
                    <p class="stat-text">Penyetoran simpanan wajib & sukarela langsung melalui potongan slip gaji bulanan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="stat-card-compact">
                    <div class="stat-icon"><i class="bi bi-phone-vibrate"></i></div>
                    <div class="stat-title">Monitoring Digital 24/7</div>
                    <p class="stat-text">Pantau riwayat saldo dan estimasi dividen secara *real-time* via portal anggota SIKOPI.</p>
                </div>
            </div>
        </div>

    </div>
</section>