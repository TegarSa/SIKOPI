<style>
    .calc-section {
        background-color: var(--color-bg-light);
        padding: 80px 0;
    }

    .calc-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 15px 35px rgba(26, 35, 45, 0.04);
        border: 1px solid rgba(152, 135, 128, 0.18);
    }

    .calc-section-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1a232d;
        letter-spacing: -0.3px;
    }

    .loan-type-btn {
        background: #f4efed;
        border: 1px solid rgba(152, 135, 128, 0.25);
        color: #555;
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
        text-align: center;
    }

    .loan-type-btn.active {
        background: var(--color-primary);
        color: #ffffff;
        border-color: var(--color-primary);
        box-shadow: 0 4px 12px rgba(26, 35, 45, 0.15);
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
        background: var(--color-terracotta);
        cursor: pointer;
        box-shadow: 0 0 8px rgba(143, 97, 82, 0.4);
    }

    .summary-box {
        background: var(--color-primary);
        border-radius: 16px;
        padding: 28px;
        color: #ffffff;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .btn-apply {
        background: linear-gradient(135deg, var(--color-terracotta) 0%, #724b3e 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 12px 20px;
        border-radius: 10px;
        border: none;
        transition: all 0.2s ease;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-apply:hover {
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(143, 97, 82, 0.3);
        transform: translateY(-1px);
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .calc-section { padding: 60px 0; }
        .calc-card { padding: 28px; }
        .calc-section-title { font-size: 1.4rem; }
    }

    @media (max-width: 767px) {
        .calc-section { padding: 50px 0; }
        .calc-card { padding: 20px; }
        .calc-section-title { font-size: 1.25rem; }
        .summary-box { padding: 22px; margin-top: 20px; }
    }
</style>

<section class="calc-section">
    <div class="container">
        
        <div class="text-center mb-4">
            <span class="text-uppercase fw-bold text-muted" style="letter-spacing: 1.5px; font-size: 0.7rem;">Simulasi Transparan</span>
            <h2 class="calc-section-title mt-1">Kalkulator Angsuran Pinjaman</h2>
        </div>

        <div class="calc-card">
            <div class="row g-4 align-items-stretch">
                
                <div class="col-lg-7 col-12">
                    
                    <div class="mb-4">
                        <label class="fw-semibold text-secondary mb-2" style="font-size: 0.8rem;">Pilih Jenis Pinjaman</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <button type="button" class="loan-type-btn active" id="btnPokok" onclick="selectLoanType('pokok')">
                                    Pinjaman Pokok <span class="d-block text-muted small mt-1" style="font-size: 0.68rem;">(6% / Tahun)</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="loan-type-btn" id="btnDarurat" onclick="selectLoanType('darurat')">
                                    Pinjaman Darurat <span class="d-block text-muted small mt-1" style="font-size: 0.68rem;">(24% / Tahun)</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold text-secondary" style="font-size: 0.8rem;">Jumlah Pinjaman</label>
                            <span class="fw-bold text-dark" style="font-size: 1.1rem;" id="loanAmountText">Rp 10.000.000</span>
                        </div>
                        <input type="range" class="calc-slider" id="loanAmount" min="1000000" max="50000000" step="1000000" value="10000000">
                        <div class="d-flex justify-content-between text-muted small mt-1" style="font-size: 0.7rem;">
                            <span>Rp 1 Juta</span>
                            <span>Rp 50 Juta</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold text-secondary" style="font-size: 0.8rem;">Jangka Waktu (Tenor)</label>
                            <span class="fw-bold text-dark" style="font-size: 1.1rem;" id="loanTenureText">12 Bulan</span>
                        </div>
                        <input type="range" class="calc-slider" id="loanTenure" min="3" max="36" step="3" value="12">
                        <div class="d-flex justify-content-between text-muted small mt-1" style="font-size: 0.7rem;">
                            <span>3 Bulan</span>
                            <span>36 Bulan</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background: rgba(152, 135, 128, 0.08);">
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">
                            <i class="bi bi-info-circle me-1 text-dark"></i> Bunga dihitung per tahun secara proporsional. Tanpa biaya admin tersembunyi.
                        </p>
                    </div>

                </div>

                <div class="col-lg-5 col-12">
                    <div class="summary-box">
                        <div>
                            <span class="text-uppercase" style="color: var(--color-accent-gold); letter-spacing: 1px; font-size: 0.7rem;">Estimasi Angsuran</span>
                            <h3 class="fw-bold text-white mt-1 mb-3" style="font-size: 1.6rem;" id="monthlyPaymentText">Rp 883.333 <span class="fw-normal text-secondary" style="font-size: 0.8rem;">/bln</span></h3>

                            <hr style="border-color: rgba(255,255,255,0.08); margin: 15px 0;">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary" style="font-size: 0.78rem;">Suku Bunga / Tahun</span>
                                <span class="text-white fw-bold" style="font-size: 0.78rem;" id="summaryRate">6%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary" style="font-size: 0.78rem;">Pokok Pinjaman</span>
                                <span class="text-white fw-bold" style="font-size: 0.78rem;" id="summaryPrincipal">Rp 10.000.000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary" style="font-size: 0.78rem;">Total Bunga</span>
                                <span class="text-white fw-bold" style="font-size: 0.78rem;" id="summaryInterest">Rp 600.000</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="#" class="btn-apply">
                                Ajukan Pinjaman Sekarang <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<script>
    let currentAnnualRate = 0.06;

    function selectLoanType(type) {
        const btnPokok = document.getElementById('btnPokok');
        const btnDarurat = document.getElementById('btnDarurat');
        
        if (type === 'pokok') {
            currentAnnualRate = 0.06;
            btnPokok.classList.add('active');
            btnDarurat.classList.remove('active');
        } else {
            currentAnnualRate = 0.24;
            btnDarurat.classList.add('active');
            btnPokok.classList.remove('active');
        }
        calculateLoan();
    }

    function calculateLoan() {
        const loanAmount = document.getElementById('loanAmount');
        const loanTenure = document.getElementById('loanTenure');
        
        const loanAmountText = document.getElementById('loanAmountText');
        const loanTenureText = document.getElementById('loanTenureText');
        const monthlyPaymentText = document.getElementById('monthlyPaymentText');
        const summaryRate = document.getElementById('summaryRate');
        const summaryPrincipal = document.getElementById('summaryPrincipal');
        const summaryInterest = document.getElementById('summaryInterest');

        const amount = parseFloat(loanAmount.value);
        const tenure = parseInt(loanTenure.value);

        const annualInterest = amount * currentAnnualRate;
        const totalInterest = (annualInterest / 12) * tenure;
        const monthlyPrincipal = amount / tenure;
        const monthlyInterest = totalInterest / tenure;
        const totalMonthly = monthlyPrincipal + monthlyInterest;

        loanAmountText.innerText = 'Rp ' + amount.toLocaleString('id-ID');
        loanTenureText.innerText = tenure + ' Bulan';
        monthlyPaymentText.innerHTML = 'Rp ' + Math.round(totalMonthly).toLocaleString('id-ID') + ' <span class="fw-normal text-secondary" style="font-size: 0.8rem;">/bln</span>';
        summaryRate.innerText = (currentAnnualRate * 100) + '%';
        summaryPrincipal.innerText = 'Rp ' + amount.toLocaleString('id-ID');
        summaryInterest.innerText = 'Rp ' + Math.round(totalInterest).toLocaleString('id-ID');
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('loanAmount').addEventListener('input', calculateLoan);
        document.getElementById('loanTenure').addEventListener('input', calculateLoan);
    });
</script>