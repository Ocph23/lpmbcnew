<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Backend.LPM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkreditasi"
            aria-expanded="true" aria-controls="collapseAkreditasi">
            <i class="fas fa-bell"></i>
            <span>Akreditasi</span>
        </a>
        <div id="collapseAkreditasi" class="collapse" aria-labelledby="headingAkreditasi"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Akreditasi:</h6>
                <a class="collapse-item" href="{{ route('dashboard.akreditasidb') }}">
                    <span>Skor Akreditasi</span>
                </a>
                <a class="collapse-item" href="{{ route('dashboard.institusi') }}">
                    <span>Institusi</span>
                </a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('calendar') }}">
            <i class="fas fa-calendar"></i>
            <span>Kalender Akademik</span>
        </a>
    </li>

    <!-- Nav Item - Umum -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUmum"
            aria-expanded="true" aria-controls="collapseUmum">
            <i class="fas fa-bell"></i>
            <span>Umum</span>
        </a>
        <div id="collapseUmum" class="collapse" aria-labelledby="headingUmum" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan :</h6>
                <a class="collapse-item" href="/admin/laporans">Laporan</a>
                <a class="collapse-item" href="cards.html">Sambutan</a>
                <a class="collapse-item" href="cards.html">Berita</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pengelolaan Mutu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMutu"
            aria-expanded="true" aria-controls="collapseMutu">
            <i class="fas fa-bell"></i>
            <span>Pengelolaan Mutu</span>
        </a>
        <div id="collapseMutu" class="collapse" aria-labelledby="headingMutu" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengelolaan Mutu:</h6>
                <a class="collapse-item" href="/admin/standars">Standar Mutu</a>
                <a class="collapse-item" href="/admin/units">Unit</a>
                <a class="collapse-item" href="/admin/documents">Dokumen</a>
                <a class="collapse-item" href="/admin/audit-schedules">Jadwal Audit</a>
                <a class="collapse-item" href="/admin/audit-instruments">Instrumen Audit</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengelolaan User</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                <a class="collapse-item" href="{{ route('users.index') }}">Users</a>
            </div>


            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengelolaan User:</h6>
                <a class="collapse-item" href="{{ route('profile') }}">Profile</a>
                <a class="collapse-item" href="{{ route('settings') }}">Security</a>
            </div>
        </div>
    </li>
</ul>
