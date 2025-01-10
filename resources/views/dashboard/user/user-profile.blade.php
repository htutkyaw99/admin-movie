<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-admin.sidebar activePage="users"></x-admin.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-admin.navbar titlePage='User Profile'></x-admin.navbar>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4" style="margin-top: 25px">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative" style="margin-left: 10px">
                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{-- {{ auth()->user()->name }} --}}
                            </h5>
                            <h3 class="mb-3">{{ $admin->name ?? 'Test User' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="javascript:;">
                                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Profile"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        {{-- <hr class="horizontal gray-light my-4"> --}}
                        <hr>
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Email
                                    Address : </strong>{{ $admin->email ?? 'Test Email' }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Role : </strong>
                                {{ $admin->role->name ?? 'Admin' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- <x-footers.auth></x-footers.auth> --}}
    </div>
    {{-- <x-plugins></x-plugins> --}}

</x-layout>
