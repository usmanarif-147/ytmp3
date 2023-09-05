<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                {{ $heading }}
                <span>
                    <h5 style="margin-top:10px"> Total: {{ $total }} </h4>
                </span>
            </h2>
            <h5 class="card-header">
                @if ($page_static_meta)
                    <a class="btn btn-primary" href="{{ route('edit.static.page.meta') }}">
                        {{-- <a class="btn btn-primary" href="{{ route('add.static.page.meta') }}"> --}}
                        <i class='bx bx-pencil'></i>
                        Edit Static Meta Details
                    </a>
                @else
                    <a class="btn btn-primary" href="{{ route('add.static.page.meta') }}">
                        <i class='bx bx-plus'></i>
                        Add Static Meta Details
                    </a>
                @endif
                <a class="btn btn-primary" href="{{ route('create.page') }}"> Create Page
                </a>
            </h5>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3 offset-md-6">
                    <label for=""> Select status </label>
                    <select wire:model="filterByStatus" class="form-control form-select me-2">
                        <option value="" selected> Select Status </option>
                        @foreach ($statuses as $val => $status)
                            <option value="{{ $val }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for=""> Search by Name </label>
                    <input class="form-control me-2" type="search" wire:model.debounce.500ms="searchQuery"
                        placeholder="Search" aria-label="Search">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th> Title </th>
                                <th> Slug </th>
                                <th> Language </th>
                                {{-- <th> Status </th> --}}
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages['pages'] as $page)
                                <tr>
                                    <td> {{ $page->page_title }}</td>
                                    <td> {{ $page->slug }}</td>
                                    <td> {{ $page->page_language }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $page->status ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                            {{ $page->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li>
                                                        <a class="dropdown-item fw-bold text-warning"
                                                            href="{{ route('edit.page', $page->id) }}">
                                                            <i class='bx bx-pencil'></i> Edit Page
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item fw-bold {{ $page->dynamic_meta ? 'text-warning' : 'text-success' }}"
                                                            href="{{ $page->dynamic_meta ? route('edit.dynamic.page.meta', $page->id) : route('add.dynamic.page.meta', $page->id) }}">
                                                            @if ($page->dynamic_meta)
                                                                <i class="bx bx-pencil"></i>
                                                            @else
                                                                <i class='bx bx-plus'></i>
                                                            @endif
                                                            {{ $page->dynamic_meta ? 'Edit Dynamic Meta Details' : 'Add Dynamic Meta Details' }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item fw-bold {{ $page->feature ? 'text-warning' : 'text-success' }}"
                                                            href="{{ $page->feature ? route('edit.page.feature', $page->id) : route('add.page.feature', $page->id) }}">
                                                            @if ($page->feature)
                                                                <i class="bx bx-pencil"></i>
                                                            @else
                                                                <i class='bx bx-plus'></i>
                                                            @endif
                                                            {{ $page->feature ? 'Edit Feature Content' : 'Add Feature Content' }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item fw-bold {{ $page->help ? 'text-warning' : 'text-success' }}"
                                                            href="{{ $page->help ? route('edit.page.help', $page->id) : route('add.page.help', $page->id) }}">
                                                            @if ($page->help)
                                                                <i class="bx bx-pencil"></i>
                                                            @else
                                                                <i class='bx bx-plus'></i>
                                                            @endif
                                                            {{ $page->help ? 'Edit Help Content' : 'Add Help Content' }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item fw-bold {{ $page->faqs ? 'text-warning' : 'text-success' }}"
                                                            href="{{ $page->faqs ? route('edit.page.faqs', $page->id) : route('add.page.faqs', $page->id) }}">
                                                            @if ($page->faqs)
                                                                <i class="bx bx-pencil"></i>
                                                            @else
                                                                <i class='bx bx-plus'></i>
                                                            @endif
                                                            {{ $page->faqs ? 'Edit Faqs Content' : 'Add Faqs Content' }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        @if ($page->status)
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item fw-bold text-danger"
                                                                wire:click="deactivateConfirmModal({{ $page->id }})">
                                                                <i class="fa fa-eye-slash"></i>
                                                                Deativate
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item fw-bold text-success"
                                                                wire:click="activateConfirmModal({{ $page->id }})">
                                                                <i class="fa fa-eye"></i>
                                                                Activate
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="demo-inline-spacing">
                        @if ($pages['pages']->count() > 0)
                            {{ $pages['pages']->links() }}
                        @else
                            <p class="text-center"> No Record Found </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    @include('partials.confirm_modal')

</div>

@section('script')
    <script>
        window.addEventListener('swal:modal', event => {
            $('#confirmModal').modal('hide');
            swal({
                title: event.detail.message,
                icon: event.detail.type,
            });
        });

        window.addEventListener('close-modal', event => {
            $('#confirmModal').modal('hide');
        });

        window.addEventListener('confirm-modal', event => {
            $('#confirmModal').modal('show');
        });
    </script>
@endsection
