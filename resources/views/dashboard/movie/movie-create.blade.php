<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-admin.sidebar activePage="movies"></x-admin.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-admin.navbar titlePage='Create Movie'></x-admin.navbar>
        <!-- End Navbar -->
        {{-- redonemovieposter.jpg --}}
        <div class="container-fluid px-2 px-md-4">
            <div id="bgImage" class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('/assets/img/landscape.svg'); background-position: center center; background-size: cover; background-repeat:no-repeat">
                <span class="mask opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{-- {{ auth()->user()->name }} --}}
                            </h5>
                            {{-- <h3 class="mb-3">Red One ( 2024 )</h3> --}}
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Fill movie Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method='POST' action='{{ route('movies.store') }}' enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Released Date</label>
                                    <input type="date" name="release_date" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('release_date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Trailer Link</label>
                                    <input type="text" name="trailer" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('trailer')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Production</label>
                                    <select name="production_id" class="form-select px-3 py-2"
                                        aria-label="Default select example">
                                        @foreach ($productions as $production)
                                            <option value="{{ $production->id }}">{{ $production->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('production_id')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">Description</label>
                                    <textarea class="form-control border border-2 p-2" placeholder="" id="floatingTextarea2" rows="4" cols="50"
                                        name="description"></textarea>
                                    @error('description')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Director</label>
                                    <select name="director_id" class="form-select px-3 py-2"
                                        aria-label="Default select example">
                                        @foreach ($directors as $director)
                                            <option value="{{ $director->id }}">{{ $director->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('director_id')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Movie Type</label>
                                    <select name="type_id" class="form-select px-3 py-2"
                                        aria-label="Default select example">
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="exampleSelectMultiple" class="form-label">Upload Image Banner</label>
                                    <input type="file" name="image" id="" class="form-control"
                                        onchange="previewBackground(event)">
                                    @error('image')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Actors and Actresses</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($actors as $actor)
                                            <div class="me-3">
                                                <input type="checkbox" name="actors[]" class="border border-2 p-2"
                                                    value="{{ $actor->id }}">
                                                <span>{{ $actor->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('actors')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Give Rating</label>
                                    <input type="number" name="rating" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('rating')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Genres</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($genres as $genre)
                                            <div class="me-3">
                                                <input type="checkbox" name="genres[]" class="border border-2 p-2"
                                                    value="{{ $genre->id }}">
                                                <span>{{ $genre->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('genres')
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

    <script>
        function previewBackground(event) {
            const imageInput = event.target;
            const bgImageDiv = document.getElementById('bgImage');

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    bgImageDiv.style.backgroundImage = `url('${e.target.result}')`;
                };

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                console.log("No file selected or file input is empty.");
            }
        }
    </script>



</x-layout>
