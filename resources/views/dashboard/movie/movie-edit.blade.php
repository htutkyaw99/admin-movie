<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-admin.sidebar activePage="movies"></x-admin.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-admin.navbar titlePage='Edit Movie'></x-admin.navbar>
        <!-- End Navbar -->
        {{-- redonemovieposter.jpg --}}
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('/assets/img/landscape.svg'); background-position: center center; background-size: cover;">
                <span class="mask opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{-- {{ auth()->user()->name }} --}}
                            </h5>
                            <h3 class="mb-3">{{ $movie->name ?? 'Movie One' }}</h3>
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
                        <form method='POST' action='{{ route('movies.update', ['movie' => 1]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                        value='{{ old('name') }}'>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Released Date</label>
                                    <input type="date" name="release_date" class="form-control border border-2 p-2"
                                        value='{{ old('release_date') }}'>
                                    @error('release_date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Director</label>
                                    <input type="text" name="director" class="form-control border border-2 p-2"
                                        value='{{ old('director') }}'>
                                    @error('director')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Production</label>
                                    <input type="text" name="production" class="form-control border border-2 p-2"
                                        value='{{ old('production') }}'>
                                    @error('production')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">Description</label>
                                    <textarea class="form-control border border-2 p-2" placeholder="" id="floatingTextarea2" name="about" rows="4"
                                        cols="50" name="description" value='{{ old('description') }}'></textarea>
                                    @error('description')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Type</label>
                                    <select name="type" class="form-select px-3 py-2"
                                        aria-label="Default select example">
                                        <option value="1">Movie</option>
                                        <option value="2">Serie</option>
                                        <option value="3">TV-Shows</option>
                                    </select>
                                    @error('type')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Trailer Link</label>
                                    <input type="text" name="production" class="form-control border border-2 p-2"
                                        value='{{ old('trailer') }}'>
                                    @error('trailer')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="customFile">Upload Image Banner</label>
                                    <input type="file" class="form-control" id="customFile" />
                                    @error('image')
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
