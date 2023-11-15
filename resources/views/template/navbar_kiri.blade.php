<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ (Request::segment(1) == 'dashboard') ? 'active': '' }}" href="{{ url('/dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <a class="nav-link {{ (Request::segment(1) == 'master') ? 'active': '' }}" href="{{ url('/master') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Master Data
            </a>

            <a class="nav-link {{ (Request::segment(1) == 'stok_masuk') ? 'active': '' }}" href="{{ route('form_stok_masuk') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Stok Masuk
            </a>

            <a class="nav-link {{ (Request::segment(1) == 'stok_keluar') ? 'active': '' }}" href="{{ route('form_stok_keluar') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Stok Keluar
            </a>

            <a class="nav-link {{ (Request::segment(1) == 'barang_nonaktif') ? 'active': '' }}" href="{{ route('barang_nonaktif') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Barang Nonaktif
            </a>

            <a class="nav-link {{ (Request::segment(1) == 'laporan') ? 'active': '' }}" href="{{ route('laporan') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Laporan
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name }}
    </div>
</nav>
