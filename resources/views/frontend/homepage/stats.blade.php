<section class="stats-section" style="background-color: #1a232d; padding: 120px 0; width: 100%; overflow: hidden;">
    <div class="container p-0 px-3" style="max-width: 1200px; margin: 0 auto;">
        
        <div class="row align-items-center g-5">
            
            <div class="col-lg-4">
                <div class="d-flex flex-column align-items-start">
                    <span class="fw-bold text-uppercase" style="font-size: 13px; color: #856053; letter-spacing: 3px; margin-bottom: 20px;">
                        Efisiensi Sistem Internal
                    </span>
                    <h2 class="fw-bold text-white" style="font-size: 2.5rem; line-height: 1.3; margin-bottom: 0; max-width: 350px;">
                        Rekapitulasi Data Operasional Pengurus
                    </h2>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4">

                    <div class="col-md-4 col-6">
                        <div class="stat-box h-100">
                            <h3 class="stat-counter fw-bold" data-target="{{ $totalAnggota }}">
                                {{ $totalAnggota }}
                            </h3>
                            <p>Data Anggota Terdaftar</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="stat-box h-100">

                            <div class="stat-money" style="margin-top: -27px;">
                                <span class="currency">Rp</span>

                                @if($totalKas >= 1000000000)
                                    <h3 class="stat-counter fw-bold m-0"
                                        data-target="{{ round($totalKas / 1000000000, 2) }}">
                                        {{ round($totalKas / 1000000000, 2) }}
                                    </h3>
                                    <span class="unit">M</span>

                                @elseif($totalKas >= 1000000)
                                    <h3 class="stat-counter fw-bold m-0"
                                        data-target="{{ round($totalKas / 1000000, 2) }}">
                                        {{ round($totalKas / 1000000, 2) }}
                                    </h3>
                                    <span class="unit">Jt</span>

                                @else
                                    <h3 class="stat-counter fw-bold m-0"
                                        data-target="{{ $totalKas }}">
                                        {{ $totalKas }}
                                    </h3>
                                @endif
                            </div>

                            <p>Posisi Kas Utama</p>

                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="stat-box h-100">
                            <h3 class="stat-counter fw-bold"
                                data-target="{{ $totalKategori }}">
                                {{ $totalKategori }}
                            </h3>
                            <p>Kategori Transaksi Dikelola</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>