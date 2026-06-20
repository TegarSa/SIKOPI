<style>
    .sidebar, 
    .sidebar-content, 
    .sidebar-link, 
    a.sidebar-link {
        background: #1a232d !important;
    }
    
    .sidebar-link, 
    a.sidebar-link {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    
    .sidebar-link:hover {
        background: #24313f !important;
        color: #fff !important;
    }
</style>

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">

     <div class="sidebar-header" style="position: relative; height: 70px;">
            <a class="sidebar-brand d-block" href="#"
            style="position: absolute; 
                    top: -20px;
                    left: 6px;     
                    height: 125px; 
                    width: calc(100% - 20px);
                    background: url('{{ asset('/assets/img/logo.png') }}') no-repeat;
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: left top;">
            </a>
        </div>

        <div class="sidebar-user text-center my-3">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->photo_profile
                            ? asset('/assets/photo_profile/' . auth()->user()->photo_profile) 
                            : asset('/assets/img/Default.png') }}" 
                    alt="User Avatar" 
                    class="rounded avatar img-fluid me-2">
                    <div class="text-start flex-fill">
                        <div class="d-flex align-items-center justify-content-start gap-2">
                            <span class="fw-semibold text-white">{{ auth()->user()->name }}</span>
                            <span class="dropdown-toggle text-white"></span>
                        </div>
                        <div class="text-secondary fs-6">{{ auth()->user()->role }}</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none"></form>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="sidebar-nav">

            <li class="sidebar-header">Menu</li>

            <li class="sidebar-item">
                <a data-bs-target="#dashboard" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i data-feather="sliders"></i>
                    <span>Dashboards</span>
                </a>
                <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('dashboard') }}">Analytics</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('profile') }}" class="sidebar-link">
                    <i data-feather="user"></i>
                    <span>Profil</span>
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
            <li class="sidebar-item">
                <a href="{{ route('admin.users.index') }}" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span>Kelola Staff</span>
                </a>
            </li>
            @endif

            <li class="sidebar-header">Pengelolaan</li>

            {{-- ================= KOMISARIS ================= --}}
            @if(auth()->user()->role === 'komisaris')

            <li class="sidebar-item">
                <a href="{{ route('komisaris.anggota.index') }}" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span>Anggota</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('komisaris.simpanan.index') }}" class="sidebar-link">
                    <i data-feather="briefcase"></i>
                    <span>Simpanan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('komisaris.pinjaman.index') }}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Pinjaman</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('komisaris.transaksi.index') }}" class="sidebar-link">
                    <i data-feather="repeat"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('komisaris.shu.index') }}" class="sidebar-link">
                    <i data-feather="pie-chart"></i>
                    <span>SHU</span>
                </a>
            </li>

            @endif

            {{-- ================= KETUA ================= --}}
            @if(auth()->user()->role === 'ketua')

            <li class="sidebar-item">
                <a href="{{ route('ketua.pinjaman.index') }}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Pinjaman</span>
                </a>
            </li>

            @endif

            {{-- ================= SEKRETARIS ================= --}}
            @if(auth()->user()->role === 'sekretaris')

            <li class="sidebar-item">
                <a href="{{ route('anggota.index') }}" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span>Kelola Anggota</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('simpanan.index') }}" class="sidebar-link">
                    <i data-feather="briefcase"></i>
                    <span>Simpanan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('pinjaman.index') }}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Pinjaman</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('transaksi.index') }}" class="sidebar-link">
                    <i data-feather="credit-card"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            @endif


            {{-- ================= BENDAHARA ================= --}}
            @if(auth()->user()->role === 'bendahara')

            <li class="sidebar-item">
                <a href="{{ route('bendahara.simpanan.index') }}" class="sidebar-link">
                    <i data-feather="briefcase"></i>
                    <span>Verifikasi Simpanan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('bendahara.pinjaman.index') }}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Verifikasi Pinjaman</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('bendahara.transaksi.index') }}" class="sidebar-link">
                    <i data-feather="repeat"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('bendahara.laporan.index') }}" class="sidebar-link">
                    <i data-feather="trending-up"></i>
                    <span>Laporan Keuangan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('shu.index') }}" class="sidebar-link">
                    <i data-feather="pie-chart"></i>
                    <span>SHU</span>
                </a>
            </li>

            @endif
        </ul>
    </div>
</nav>
