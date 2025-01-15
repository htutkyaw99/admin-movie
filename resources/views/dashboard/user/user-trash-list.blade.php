<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-admin.sidebar activePage="users-trash"></x-admin.sidebar>
    <main class="main-content position-relative max-height-vh-100 border-radius-lg " style="overflow-y: hidden">
        <!-- Navbar -->
        <x-admin.navbar titlePage="User Management"></x-admin.navbar>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Users Trashed Items
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if ($admins->isNotEmpty())
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Email</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Role</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loop->index + 1 }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $admin->name ?? 'Jhon' }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $admin->email ?? 'jhon@gmail.com' }}
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $admin->role->name ?? 'Super Admin' }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle d-flex">
                                                        <form method="POST" id="restoreForm"
                                                            action="{{ route('admins.restore', ['admin' => $admin->id]) }}">
                                                            @csrf
                                                            <button type="button" class="btn btn-success btn-link"
                                                                style="margin-left: 5px" data-bs-toggle="modal"
                                                                data-bs-target="#restoreModal{{ $admin->id }}">
                                                                <span class="material-icons">
                                                                    settings_backup_restore
                                                                </span>
                                                                <div class="ripple-container"></div>
                                                            </button>

                                                            <div class="modal fade" id="restoreModal{{ $admin->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="restoreModal{{ $admin->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="restoreModal{{ $admin->id }}">
                                                                                Confirmed?</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are u sure to restore this item?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success">Restore
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>


                                                        <form method="POST" id="deleteForm"
                                                            action="{{ route('admins.force', ['admin' => $admin->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-link"
                                                                style="margin-left: 5px" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $admin->id }}">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="deleteModal{{ $admin->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="deleteModal{{ $admin->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="deleteModal{{ $admin->id }}">
                                                                                Confirmed?</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are u sure to remove this item
                                                                            permenantly?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Delete
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h6 class="text-center">There isn't any items yet!</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById("deleteForm");
            const form2 = document.getElementById("restoreForm");
            form.addEventListener('submit', function() {
                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerText = 'Submitting...';
            });
            form2.addEventListener('submit', function() {
                const submitButton = form2.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerText = 'Submitting...';
            });
        });
    </script>

</x-layout>
