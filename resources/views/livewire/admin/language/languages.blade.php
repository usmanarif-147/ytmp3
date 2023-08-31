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
                <a class="btn btn-primary" href="{{ route('create.language') }}"> Create
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
                <div class="table-responsive text-nowrap">
                    <table class="table admin-table">
                        <thead class="table-light">
                            <tr>
                                <th> Image </th>
                                <th> Name </th>
                                <th> Lang </th>
                                <th> Content Uploaded </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($langs['langs'] as $lang)
                                <tr>
                                    <td>
                                        <div class="img-holder">
                                            <img src="{{ asset(isImageExist($lang->flag)) }}" alt="">
                                        </div>
                                    </td>
                                    <td> {{ $lang->name }}</td>
                                    <td> {{ $lang->lang }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $lang->content ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                            {{ $lang->content ? 'Uploaded' : 'Not Uploaded' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $lang->status ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                            {{ $lang->status ? 'Activated' : 'Deactivated' }}
                                        </span>
                                    </td>
                                    <td class="action-td">
                                        @if (!$lang->status)
                                            <button class="btn btn-icon btn-outline-secondary" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="" data-bs-original-title="<span>Activate</span>"
                                                wire:click="activateConfirmModal({{ $lang->id }})">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-icon btn-outline-secondary" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="" data-bs-original-title="<span>Deactivate</span>"
                                                wire:click="deactivateConfirmModal({{ $lang->id }})">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                        @endif
                                        <a class="btn btn-icon btn-outline-secondary" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            title="" data-bs-original-title="<span>Edit</span>"
                                            href="{{ route('edit.language', $lang->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>

                                    {{-- <td class="action-td">
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                @if ($lang->status == 0)
                                                    <button class="btn btn-icon btn-outline-secondary"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title=""
                                                        data-bs-original-title="<i class='fa fa-eye bx-xs' ></i> <span>Activate</span>"
                                                        wire:click="activateConfirmModal({{ $lang->id }})">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-icon btn-outline-secondary"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title=""
                                                        data-bs-original-title="<i class='fa fa-slash bx-xs' ></i> <span>Deactivate</span>"
                                                        wire:click="deactivateConfirmModal({{ $lang->id }})">
                                                        <i class="fa fa-eye-slash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="demo-inline-spacing">
                        @if ($langs['langs']->count() > 0)
                            {{ $langs['langs']->links() }}
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
