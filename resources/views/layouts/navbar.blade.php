<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Tombol toggle sidebar -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    @if(request()->is('penduduk*'))
    <form action="{{ route('penduduk.index') }}" method="GET" class="form-inline mr-auto d-none d-md-flex">
        <div class="input-group">
            <input type="text" name="kk" class="form-control bg-light border-0 small"
                placeholder="Cari berdasarkan KK" value="{{ request('kk') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    @elseif(request()->is('mutasi*'))
    <form action="{{ route('mutasi.index') }}" method="GET" class="form-inline mr-auto d-none d-md-flex">
        <div class="input-group">
            <input type="text" name="kk" class="form-control bg-light border-0 small"
                placeholder="Cari berdasarkan KK" value="{{ request('kk') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    @endif

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        @php
            $hariMap = [
                1 => 'Senin',
                2 => 'Selasa',
                3 => 'Rabu',
                4 => 'Kamis',
                5 => 'Jumat',
                6 => 'Sabtu',
                7 => 'Minggu',
            ];
            $hari = $hariMap[(int) date('N')] ?? '';
            $tanggal = date('d M Y');
        @endphp

        <li class="nav-item d-none d-sm-inline-block">
            <span class="nav-link text-gray-600 small">{{ $hari }}, {{ $tanggal }}</span>
        </li>

        <!-- Notifikasi -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                @if(isset($notifCount) && $notifCount > 0)
                    <span class="badge badge-danger badge-counter">{{ $notifCount }}</span>
                @endif
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Notifikasi</h6>
                @if(isset($notifCount) && $notifCount > 0)
                    @foreach($notifications as $notif)
                        <a class="dropdown-item d-flex align-items-center" href="{{ $notif['link'] }}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas {{ $notif['icon'] }} text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $notif['time'] }}</div>
                                <span class="font-weight-bold">{{ $notif['text'] }}</span>
                            </div>
                        </a>
                    @endforeach
                @else
                    <a class="dropdown-item text-center small text-gray-500" href="#">Belum ada notifikasi</a>
                @endif
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- User Info -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->check() ? auth()->user()->name : 'Admin' }}
                </span>
                @php
                    $role = auth()->check() ? auth()->user()->role : null;
                    $profileImage = $role === 'admin'
                        ? asset('img/admin.jpeg')
                        : asset('img/pegawai.png');
                @endphp
                <img class="img-profile rounded-circle" src="{{ $profileImage }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
