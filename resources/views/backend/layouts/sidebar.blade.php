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
                            ? asset('assets/photo_profile/' . auth()->user()->photo_profile) 
                            : asset('assets/img/Default.png') }}" 
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

            <li class="sidebar-item">
                <a data-bs-target="#pelatihan" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i data-feather="briefcase"></i>
                    <span>Manajemen Persediaan</span>
                </a>
                <ul id="pelatihan" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('list') }}">Daftar Stok</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stock.in.create') }}">Stok Masuk</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('products.index') }}">Data Barang</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stock.out.create') }}">Stok Keluar</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#berita" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i data-feather="briefcase"></i>
                    <span>Pengadaan / Pembelian</span>
                </a>
                <ul id="berita" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('supplier.index') }}">Data Pemasok</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('po.index') }}">Purchase Order (PO)</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Riwayat PO</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#unduh" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i data-feather="briefcase"></i>
                    <span>Manajemen Gudang</span>
                </a>
                <ul id="unduh" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('report') }}">Laporan Stok Gudang</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stock.movements.index') }}">Pergerakan Stok</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#profil" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i data-feather="briefcase"></i>
                    <span>Manajemen Logistik & Distribusi</span>
                </a>
                <ul id="profil" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('shipments.index') }}">Daftar Pengiriman</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('shipments.tracking') }}">Tracking Pengiriman</a></li>
                    <!-- <li class="sidebar-item"><a class="sidebar-link" href="#">Riwayat Distribusi</a></li> -->
                </ul>
            </li>
        </ul>
    </div>
</nav>
