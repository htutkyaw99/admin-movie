@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Admin Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'users' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('admins.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="material-icons opacity-10">table_view</i> --}}
                        <span class="material-icons">
                            people_alt
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'movies' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('movies.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="material-icons opacity-10">receipt_long</i> --}}
                        <span class="material-icons">
                            movie
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Movies</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Trashed Items</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'users-trash' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('admins.trash') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="material-icons opacity-10">table_view</i> --}}
                        <span class="material-icons">
                            delete_outline
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'movies-trash' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('movies.trash') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="material-icons opacity-10">receipt_long</i> --}}
                        <span class="material-icons">
                            delete
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Movies</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
