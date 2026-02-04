
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-users"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIDUK</div>
            </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('penduduk*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('penduduk.index') }}">
            <i class="fas fa-users"></i>
            <span>Data Penduduk</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('mutasi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('mutasi.index') }}">
            <i class="fas fa-exchange-alt"></i>
            <span>Data Mutasi Penduduk</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('laporan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Laporan</span>
        </a>
    </li>
    @if(auth()->check() && auth()->user()->role === 'admin')
    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-user-cog"></i>
            <span>Manajemen User</span>
        </a>
    </li>
    @endif
</ul>
