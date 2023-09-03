<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <div class="app-brand d-flex justify-content-center align-items-center">
                <img src="{{ asset('sneat-1.0.0/assets/img/all/logo-sidebar.png') }}" width="50%" alt="Brand Logo"
                    class="img-fluid" />
            </div>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @stack('Dashboard')">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @if (session('role') == 1)
            <li class="menu-item @stack('Users')">
                <a href="{{ route('user') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx  bx-table"></i>
                    <div data-i18n="Analytics">Users</div>
                </a>
            </li>
        @endif

        @if (session('role') == 1)
            <li class="menu-item @stack('Pasien')">
                <a href="{{ route('pasien') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Analytics">Pasien</div>
                </a>
            </li>
        @endif

        @if (session('role') == 1)
            <li class="menu-item @stack('Gejala')">
                <a href="{{ route('gejala') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx  bx-table"></i>
                    <div data-i18n="Analytics">Gejala</div>
                </a>
            </li>
        @endif

        @if (session('role') == 1)
            <li class="menu-item @stack('Tindakan')">
                <a href="{{ route('tindakan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx  bx-table"></i>
                    <div data-i18n="Analytics">Tindakan</div>
                </a>
            </li>
        @endif

        @if (session('role') == 1)
            <li class="menu-item @stack('Rule')">
                <a href="{{ route('rule') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx  bx-table"></i>
                    <div data-i18n="Analytics">Rule</div>
                </a>
            </li>
        @endif

        <li class="menu-item @stack('Datas')">
            <a href="{{ route('datas') }}" class="menu-link">
                <i class="menu-icon tf-icons bx  bx-table"></i>
                <div data-i18n="Analytics">Data Rekam Medis</div>
            </a>
        </li>
    </ul>
</aside>
