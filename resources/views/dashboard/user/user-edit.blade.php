<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-admin.sidebar activePage="users"></x-admin.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-admin.navbar titlePage='Edit User'></x-admin.navbar>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4" style="margin-top: 25px">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img id="avatar"
                                src="{{ !is_null($admin->image) ? asset('storage/' . $admin->image) : asset('assets/img/drake.jpg') }}"
                                alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                                <h6 class="mb-3">Edit your Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form enctype="multipart/form-data" method='POST'
                            action='{{ route('admins.update', ['admin' => 1]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                        value='{{ old('name', $admin->name) }}'>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control border border-2 p-2"
                                        value='{{ old('email', $admin->email) }}'>
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control border border-2 p-2"
                                        value=''>
                                    @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control border border-2 p-2" value=''>
                                    @error('password_confirmation')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload user image</label>
                                        <input class="form-control" type="file" id="formFile" name="image"
                                            onchange="previewAvatar(event)">
                                    </div>
                                    @error('image')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Role</label>
                                    <select name="role_id" class="form-select px-3 py-2"
                                        aria-label="Default select example">
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                    </select>
                                    @error('type')
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
        function previewAvatar() {

            console.log('Avatar Preview');

            const imageInput = event.target;
            const avatar = document.getElementById('avatar');

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    avatar.src = e.target.result;
                };

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                console.log("No file selected or file input is empty.");
            }

        }
    </script>

</x-layout>
