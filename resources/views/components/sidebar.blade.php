<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">PUSLING</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">PSL</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.home') }}" ><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="#" ><i class="fas fa-users"></i><span>Data Permohonan</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="#" ><i class="fas fa-calendar"></i><span>Jadwal Kunjungan</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="#" ><i class="fas fa-chart-line"></i><span>Laporan Kegiatan</span></a>
            </li>
            <li class="menu-header">PENGATURAN</li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.users.index') }}"><i class="fas fa-user"></i>
                    <span>Pengguna</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.permissions') }}"><i class="fas fa-lock"></i>
                    <span>Izin Akses</span></a>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.roles.index') }}"><i class="fas fa-key"></i>
                    <span>Hak Akses</span></a>
            </li>

        </ul>
    </aside>
</div>
