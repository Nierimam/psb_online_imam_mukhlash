<nav>
    <div class="sidebar-top">
        @if(Auth::user()->role == 'Admin')
        <a href="{{ route('admin.dashboard') }}" class="logo__wrapper">
            <img src="../../../image/pmb_online/logo2.png" alt="Logo" class="logo" height="10">
            <h1 class="hide">PSB Online</h1>
        </a>
        @elseif(Auth::user()->role == 'Murid')
        <a href="{{ route('murid.dashboard') }}" class="logo__wrapper">
            <img src="../../../image/pmb_online/logo2.png" alt="Logo" class="logo" height="10">
            <h1 class="hide">PSB Online</h1>
        </a>
        @endif
        <div class="expand-btn">
            <img src="../../../image/sidebar/chevron.svg" alt="Chevron">
        </div>
    </div>
    <div class="sidebar-links">
        <ul>
            @php
            $currentRoute = Route::currentRouteName();
            @endphp
            @if(Auth::user()->role == 'Admin')
            <li class="{{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" title="Dashboard" class="tooltip">
                    <img src="../../../image/sidebar//dashboard.svg" alt="Dashboard">
                    <span class="link hide">Dashboard</span>
                    <span class="tooltip__content">Dashboard</span>
                </a>
            </li>


            <li class="{{ $currentRoute === 'admin.listusers' ? 'active' : '' }}">
                <a href="{{ route('admin.listusers') }}" title="Project" class="tooltip">
                    <i class="bi bi-people-fill" style="font-size: 1.7em"></i>
                    <span class="link hide">List Users</span>
                    <span class="tooltip__content">List Users</span>
                </a>
            </li>
            {{-- {{ $currentRoute === 'admin.category' ? 'active' : '' }}
            {{ route('admin.category') }} --}}
            <li class="{{ $currentRoute === 'admin.document.user' ? 'active' : '' }}">
                <a href="{{ route('admin.document.user') }}" title="Project" class="tooltip">
                    <i class="bi bi-grid-1x2-fill" style="font-size: 1.7em"></i>
                    <span class="link hide">Document User</span>
                    <span class="tooltip__content"> Category</span>
                </a>
            </li>
            {{-- {{ $currentRoute === 'admin.unitGudang' ? 'active' : '' }}
            {{ route('admin.unitGudang') }} --}}
            {{-- <li class="">
                <a href="" title="Performance" class="tooltip">
                    <img src="../../../image/sidebar//performance.svg" alt="Performance">
                    <span class="link hide">Unit Gudang</span>
                    <span class="tooltip__content">Unit Gudang</span>
                </a>
            </li> --}}
            @elseif(Auth::user()->role == 'Murid')
            <li class="{{ $currentRoute === 'murid.dashboard' ? 'active' : '' }}">
                <a href="{{ route('murid.dashboard') }}" title="Dashboard" class="tooltip">
                    <img src="../../../image/sidebar//dashboard.svg" alt="Dashboard">
                    <span class="link hide">Dashboard</span>
                    <span class="tooltip__content">Dashboard</span>
                </a>
            </li>
            <li class="{{ $currentRoute === 'murid.profile' ? 'active' : '' }}">
                <a href="{{ route('murid.profile') }}" title="Dashboard" class="tooltip">
                    <i class="bi bi-person-bounding-box" style="font-size: 32px"></i> <span
                        class="link hide">Dashboard</span>
                    <span class="tooltip__content">Dashboard</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="sidebar-bottom">
        <div class="sidebar-links">
            <ul>
                <li>
                    @if(Auth::user()->role == 'Admin')
                    <a href="{{ route('admin.logout') }}" title="Logout" class="tooltip">
                        <i class="bi bi-box-arrow-in-left" style="font-size: 1.7em;"></i>
                        <span class="link hide">Logout</span>
                        <span class="tooltip__content">Logout</span>
                    </a>
                    @elseif(Auth::user()->role == 'Murid')
                    <a href="{{ route('murid.logout') }}" title="Logout" class="tooltip">
                        <i class="bi bi-box-arrow-in-left" style="font-size: 1.7em;"></i>
                        <span class="link hide">Logout</span>
                        <span class="tooltip__content">Logout</span>
                    </a>
                    @endif
                </li>
            </ul>
        </div>
        <div class="sidebar__profile">
            {{-- {{ route('admin.profile') }} --}}
            @php
            $currentUser = Auth::user(); // Mengambil data pengguna yang sedang login
            @endphp

            @if($currentUser->foto_profile && Storage::disk('public')->exists(str_replace('public/', '',
            $currentUser->foto_profile)))
            <img src="{{ Storage::url($currentUser->foto_profile) }}" alt="Foto Profile" height="50" width="50"
                style="border-radius: 50%" />
            @else
            <a href="" class="avatar__wrapper">
                <img class="avatar"
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=random&color=28a745"
                    alt="Profile">
                <div class="online__status"></div>
            </a>
            @endif
            <div class="avatar__name hide">
                <div class="user-name">{{ Auth::user()->nama_lengkap }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
            </div>
        </div>
    </div>
</nav>