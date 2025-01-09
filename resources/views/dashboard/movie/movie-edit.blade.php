<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-admin.sidebar activePage="movies"></x-admin.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-admin.navbar titlePage='Edit Movie'></x-admin.navbar>
        <!-- End Navbar -->
        {{-- redonemovieposter.jpg --}}
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('assets/img/redonemovieposter.jpg'); background-position: center center; background-size: cover;">
                <span class="mask opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    {{-- <div class="col-auto">
                        <div class="avatar avatar-xl overflow-hidden position-relative">
                            <img src="{{ asset('assets') }}/img/the red one.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div> --}}
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{-- {{ auth()->user()->name }} --}}
                            </h5>
                            <h3 class="mb-3">Red One ( 2024 )</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Edit movie Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('movies.update', ['movie' => 1]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="number" name="phone" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('phone')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('location')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">About</label>
                                    <textarea class="form-control border border-2 p-2" placeholder=" Say something about yourself" id="floatingTextarea2"
                                        name="about" rows="4" cols="50"></textarea>
                                    @error('about')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        {{-- <x-footers.auth></x-footers.auth> --}}
    </div>
    {{-- <x-plugins></x-plugins> --}}

</x-layout>
