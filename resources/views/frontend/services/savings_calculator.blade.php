<style>
    .savings-calc-section {
        background-color: var(--color-bg-light);
        padding: 80px 0;
    }

    .savings-type-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(152, 135, 128, 0.2);
        transition: all 0.2s ease;
        height: 100%;
    }

    .savings-type-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(26, 35, 45, 0.05);
    }

    .type-badge-mini {
        font-size: 0.68rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .badge-mandatory { background: rgba(143, 97, 82, 0.12); color: var(--color-terracotta); }
    .badge-voluntary { background: rgba(26, 35, 45, 0.08); color: var(--color-primary); }

    .calc-box-savings {
        background: #ffffff;
        border-radius: 20px;
        padding: 32px;
        border: 1px solid rgba(152, 135, 128, 0.2);
        box-shadow: 0 12px 30px rgba(26, 35, 45, 0.04);
    }

    .calc-slider {
        -webkit-appearance: none;
        width: 100%;
        height: 6px;
        border-radius: 4px;
        background: #e2d7d2;
        outline: none;
    }

    .calc-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--color-terracotta, #8f6152);
        cursor: pointer;
        box-shadow: 0 0 8px rgba(143, 97, 82, 0.4);
    }

    .savings-summary-box {
        background: var(--color-primary, #1a232d);
        border-radius: 16px;
        padding: 26px;
        color: #ffffff;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .btn-apply {
        background: linear-gradient(135deg, var(--color-terracotta, #8f6152) 0%, #724b3e 100%);
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 12px 20px;
        border-radius: 10px;
        border: none;
        transition: all 0.2s ease;
        text-align: center;
        text-decoration: none !important;
        display: block;
    }

    .btn-apply:hover {
        color: #ffffff !important;
        box-shadow: 0 6px 16px rgba(143, 97, 82, 0.3);
        transform: translateY(-1px);
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .savings-calc-section { padding: 60px 0; }
        .calc-box-savings { padding: 24px; }
    }

    @media (max-width: 767px) {
        .savings-calc-section { padding: 50px 0; }
        .calc-box-savings { padding: 18px; }
        .savings-summary-box { padding: 20px; margin-top: 20px; }
    }
</style>

<section class="savings-calc-section">
    <div class="container">
        
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold text-muted" style="letter-spacing: 1.5px; font-size: 0.7rem;">Kategori Produk</span>
            <h2 class="fw-bold text-dark mt-1" style="font-size: 1.6rem; letter-spacing: -0.3px;">Pilihan Jenis Simpanan</h2>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="savings-type-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="type-badge-mini badge-mandatory">Wajib Awal</span>
                    </div>
                    <h5 class="fw-bold text-dark" style="font-size: 0.95rem;">Simpanan Pokok</h5>
                    <p class="text-muted" style="font-size: 0.78rem; line-height: 1.5;">Dibayarkan 1x saat pertama kali menjadi anggota koperasi. Tidak dapat ditarik selama menjadi anggota.</p>
                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">Rp 100.000 <span class="text-muted fw-normal" style="font-size: 0.7rem;">/ sekali</span></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="savings-type-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="type-badge-mini badge-mandatory">Rutin Bulanan</span>
                    </div>
                    <h5 class="fw-bold text-dark" style="font-size: 0.95rem;">Simpanan Wajib</h5>
                    <p class="text-muted" style="font-size: 0.78rem; line-height: 1.5;">Setoran rutin bulanan yang dipotong langsung via payroll untuk memupuk modal kerja bersama.</p>
                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">Rp 50.000 <span class="text-muted fw-normal" style="font-size: 0.7rem;">/ bulan</span></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="savings-type-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="type-badge-mini badge-voluntary">Fleksibel</span>
                    </div>
                    <h5 class="fw-bold text-dark" style="font-size: 0.95rem;">Simpanan Sukarela</h5>
                    <p class="text-muted" style="font-size: 0.78rem; line-height: 1.5;">Bebas disetor dan ditarik sewaktu-waktu sesuai kebutuhan anggota. Bunga dihitung harian.</p>
                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">Bebas Nominal</div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="savings-type-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="type-badge-mini badge-voluntary">Investasi Plus</span>
                    </div>
                    <h5 class="fw-bold text-dark" style="font-size: 0.95rem;">Simpanan Berjangka</h5>
                    <p class="text-muted" style="font-size: 0.78rem; line-height: 1.5;">Simpanan dengan komitmen tenor (6/12 bulan) dengan rasio pembagian SHU yang lebih tinggi.</p>
                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">Est. SHU 8% <span class="text-muted fw-normal" style="font-size: 0.7rem;">/ tahun</span></div>
                </div>
            </div>
        </div>

        <div class="calc-box-savings mt-5">
            <div class="text-center mb-4">
                <span class="text-uppercase fw-bold text-muted" style="letter-spacing: 1px; font-size: 0.68rem;">Kalkulasi Dividen</span>
                <h3 class="fw-bold text-dark" style="font-size: 1.35rem;">Simulasi Pertumbuhan Simpanan & SHU</h3>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-7 col-12">
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold text-secondary" style="font-size: 0.8rem;">Setoran Sukarela Bulanan</label>
                            <span class="fw-bold text-dark" style="font-size: 1.05rem;" id="savingMonthlyText">Rp 500.000</span>
                        </div>
                        <input type="range" class="calc-slider" id="savingMonthly" min="100000" max="5000000" step="100000" value="500000">
                        <div class="d-flex justify-content-between text-muted small mt-1" style="font-size: 0.68rem;">
                            <span>Rp 100 Ribu</span>
                            <span>Rp 5 Juta</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold text-secondary" style="font-size: 0.8rem;">Durasi Menyimpan</label>
                            <span class="fw-bold text-dark" style="font-size: 1.05rem;" id="savingYearsText">1 Tahun</span>
                        </div>
                        <input type="range" class="calc-slider" id="savingYears" min="1" max="5" step="1" value="1">
                        <div class="d-flex justify-content-between text-muted small mt-1" style="font-size: 0.68rem;">
                            <span>1 Tahun</span>
                            <span>5 Tahun</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background: rgba(152, 135, 128, 0.08);">
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">
                            <i class="bi bi-info-circle me-1 text-dark"></i> Perhitungan memperhitungkan kumulatif Simpanan Wajib rutin (Rp 50rb/bln) dan estimasi dividen SHU tahunan sebesar ~7.5%.
                        </p>
                    </div>

                </div>

                <div class="col-lg-5 col-12">
                    <div class="savings-summary-box">
                        <div>
                            <span class="text-uppercase" style="color: var(--color-accent-gold); letter-spacing: 1px; font-size: 0.68rem;">Estimasi Total Dana</span>
                            <h3 class="fw-bold text-white mt-1 mb-3" style="font-size: 1.6rem;" id="totalSavingsText">Rp 7.087.500</h3>

                            <hr style="border-color: rgba(255,255,255,0.08); margin: 15px 0;">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary" style="font-size: 0.78rem;">Total Pokok Disetor</span>
                                <span class="text-white fw-bold" style="font-size: 0.78rem;" id="summaryDeposit">Rp 6.600.000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary" style="font-size: 0.78rem;">Estimasi Bagi Hasil SHU</span>
                                <span class="text-white fw-bold" style="font-size: 0.78rem;" id="summarySHU">Rp 487.500</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="#" class="btn-apply">
                                Mulai Menabung Sekarang <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    function calculateSavings() {
        const monthlyInput = document.getElementById('savingMonthly');
        const yearsInput = document.getElementById('savingYears');

        const monthlyVal = parseFloat(monthlyInput.value);
        const yearsVal = parseInt(yearsInput.value);

        const mandatoryMonthly = 50000;
        const totalMonthlySetor = monthlyVal + mandatoryMonthly;
        const months = yearsVal * 12;

        const totalPrincipal = totalMonthlySetor * months;
        const estSHURate = 0.075;
        const estSHU = (totalPrincipal * estSHURate * yearsVal) / 2;
        const grandTotal = totalPrincipal + estSHU;

        document.getElementById('savingMonthlyText').innerText = 'Rp ' + monthlyVal.toLocaleString('id-ID');
        document.getElementById('savingYearsText').innerText = yearsVal + ' Tahun';
        document.getElementById('totalSavingsText').innerText = 'Rp ' + Math.round(grandTotal).toLocaleString('id-ID');
        document.getElementById('summaryDeposit').innerText = 'Rp ' + totalPrincipal.toLocaleString('id-ID');
        document.getElementById('summarySHU').innerText = 'Rp ' + Math.round(estSHU).toLocaleString('id-ID');
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('savingMonthly').addEventListener('input', calculateSavings);
        document.getElementById('savingYears').addEventListener('input', calculateSavings);
    });
</script>