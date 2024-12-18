<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <div class="sidenav-menu-heading">Dashboard</div>
                <a class="nav-link collapsed " href="/">
                    <div class="nav-link-icon"><i data-feather="command"></i></div>
                    Dashboard
                </a>
                <div class="sidenav-menu-heading">Menu Layanan</div>
                <a class="nav-link collapsed mb-2" href="/antrian">
                    <div class="nav-link-icon"><i data-feather="list"></i></div>
                    Antrian
                </a>
                <a class="nav-link collapsed {{ Request::is('dashboard/antrian-masuk/*') ? 'show' : '' }}"  href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="{{ Request::is('dashboard/antrian-masuk/*') ? 'true' : 'false' }}" aria-controls="collapseDashboards">
                    <div class="nav-link-icon"><i data-feather="user-plus"></i></div>
                    Antrian Masuk
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('dashboard/antrian-masuk/*') ? 'show' : '' }}" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        @foreach ($dataSide as $item)
                            <a wire:navigate class="nav-link {{ request()->is('dashboard/antrian-masuk/' . $item->slug) ? 'active' : '' }}" href="/dashboard/antrian-masuk/{{ $item->slug }}"><i data-feather="chevron-right"></i>{{ $item->nama_poli_tsd }}</a>
                        @endforeach
                    </nav>
                </div>
                <div class="sidenav-menu-heading">Data Master</div>
                <a class="nav-link collapsed mt-2 {{ Request::is('polis', 'master-laporan') ? 'show' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dataMaster" aria-expanded="{{ Request::is('polis', 'master-laporan') ? 'true' : 'false' }}" aria-controls="dataMaster">
                    <div class="nav-link-icon"><i data-feather="hard-drive"></i></div>
                    Data Master
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('polis', 'master-laporan') ? 'show' : '' }}" id="dataMaster" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link {{ request()->is('polis') ? 'active' : '' }}" href="/polis">Master Layanan</a>
                        <a class="nav-link {{ request()->is('master-laporan') ? 'active' : '' }}" href="#">Master Laporan</a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>
