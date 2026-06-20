<div class="w-100" style="position: relative; z-index: 1040;">

    <div class="topbar py-3 text-white" style="background: transparent; font-size: 13px;">
        <div class="container d-flex justify-content-start gap-4 p-0 px-3" style="max-width: 1200px; margin: 0 auto;">
            <div class="d-flex align-items-center">
                <i data-feather="home" class="me-2" style="width: 14px; height: 14px; color: #e5ded9;"></i> 
                <span style="color: #e5ded9;">Koperasi Karyawan Internal</span>
            </div>
            <div class="d-flex align-items-center">
                <i data-feather="mail" class="me-2" style="width: 14px; height: 14px; color: #e5ded9;"></i> 
                <span style="color: #e5ded9;">sikopi.support@gmail.com</span>
            </div>
            <div class="d-flex align-items-center d-none d-md-flex"> 
                <i data-feather="shield" class="me-2" style="width: 14px; height: 14px; color: #e5ded9;"></i> 
                <span style="color: #e5ded9;">Sistem Informasi Koperasi Aman & Terverifikasi</span>
            </div>
        </div>
    </div>

    <div class="container mt-1 mb-4 p-0 px-3" style="max-width: 1200px; margin: 0 auto;">
        <nav class="navbar navbar-expand-lg shadow-sm p-0 border-0" style="background-color: #fcfdfd; min-height: 85px; border-radius: 4px;">
            <div class="container-fluid p-0 d-flex align-items-stretch" style="min-height: 85px;">
                
                <a class="navbar-brand d-flex align-items-center ps-4 m-0 text-decoration-none" href="#" style="min-height: 85px; gap: 12px;">
                    <div class="d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; overflow: hidden;">
                        <img src="{{ asset('assets/img/logo 2.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                    </div> 
                    <div class="d-flex flex-column justify-content-center" style="line-height: 1;">
                        <span style="color: #162224; font-weight: 800; font-size: 1.8rem; letter-spacing: -0.5px; display: block;">SIKOPI</span>
                        <span style="color: #8e847e; font-weight: 600; font-size: 6.2px; letter-spacing: 1.1px; text-transform: uppercase; display: block; margin-top: 2px; white-space: nowrap;">SISTEM KOPERASI INTERNAL</span>
                    </div>
                </a>

                <button class="navbar-toggler me-3 align-self-center" type="button" data-bs-toggle="collapse" data-bs-target="#frontNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-lg-flex align-items-stretch" id="frontNavbar">
                    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center px-4 mb-0">
                        <li class="nav-item"><a class="nav-link px-3 fw-semibold text-dark text-decoration-none" href="#" style="font-size: 15px;">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link px-3 fw-semibold text-dark text-decoration-none" href="#" style="font-size: 15px;">Tentang Kami</a></li>
                        
                        <li class="nav-item dropdown custom-dropdown">
                            <a class="nav-link dropdown-toggle px-3 fw-semibold text-dark text-decoration-none" href="#" role="button" style="font-size: 15px;">Layanan</a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm m-0">
                                <li><a class="dropdown-item fw-medium" href="#">Simpanan Anggota</a></li>
                                <li><a class="dropdown-item fw-medium" href="#">Pengajuan Pinjaman</a></li>
                                <!-- <li><a class="dropdown-item fw-medium" href="#">Angsuran & Buku Kas</a></li> -->
                            </ul>
                        </li>

                        <li class="nav-item dropdown custom-dropdown">
                            <a class="nav-link dropdown-toggle px-3 fw-semibold text-dark text-decoration-none" href="#" role="button" style="font-size: 15px;">Unduh Dokumen</a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm m-0">
                                <li><a class="dropdown-item fw-medium" href="#">Formulir Keanggotaan Baru</a></li>
                                <li><a class="dropdown-item fw-medium" href="#">Syarat & Kuasa Potong Gaji</a></li>
                                <li><a class="dropdown-item fw-medium" href="#">Berkas Pengajuan Pinjaman</a></li>
                                <li><a class="dropdown-item fw-medium" href="#">Format Surat Pengunduran Diri</a></li>
                            </ul>
                        </li>

                        <li class="nav-item"><a class="nav-link px-3 fw-semibold text-dark text-decoration-none" href="#" style="font-size: 15px;">Bantuan</a></li>
                    </ul>

                    <div class="d-flex align-items-stretch">
                        <a class="btn-login-navbar px-5 d-flex align-items-center justify-content-center text-white text-decoration-none fw-bold" 
                        href="{{ route('login') }}" 
                        style="background-color: #1a232d; font-size: 15px; border-radius: 0 4px 4px 0; min-height: 85px; white-space: nowrap; transition: background-color 0.2s;">
                            Masuk
                        </a>
                    </div>
                </div>

            </div>
        </nav>
    </div>

</div>