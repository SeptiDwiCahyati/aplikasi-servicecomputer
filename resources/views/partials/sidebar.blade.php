<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('home') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <img src="{{ asset('img/icon.png') }}" alt="Logo"
                    style="width: 62px; height: 62px; margin-right: 4px;">
                Fix Comp
            </h3>
        </a>


        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Septi Dwi Cahyati</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('keluhan.index') }}"
                class="nav-item nav-link {{ request()->routeIs('keluhan.index') ? 'active' : '' }}"><i
                    class="fa fa-exclamation-circle me-2"></i>Keluhan</a>
            <a href="{{ route('customers.index') }}"
                class="nav-item nav-link {{ request()->routeIs('customers.index') ? 'active' : '' }}"><i
                    class="fa fa-users me-2"></i>Customer</a>
            <a href="{{ route('computers.index') }}"
                class="nav-item nav-link {{ request()->routeIs('computers.index') ? 'active' : '' }}"><i
                    class="fa fa-desktop me-2"></i>Komputer</a>
            <a href="{{ route('servis.index') }}"
                class="nav-item nav-link {{ request()->routeIs('servis.index') ? 'active' : '' }}"><i
                    class="fa fa-wrench me-2"></i>Servis</a>
            <a href="{{ route('barang.index') }}"
                class="nav-item nav-link {{ request()->routeIs('barang.index') ? 'active' : '' }}"><i
                    class="fa fa-boxes me-2"></i>Barang</a>
        </div>
    </nav>
</div>
