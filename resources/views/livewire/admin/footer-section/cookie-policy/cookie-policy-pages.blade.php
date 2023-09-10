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
                <a class="btn btn-primary" href="{{ route('create.cookiepolicypages.page') }}">
                    Create Cookie Policy Page
                </a>
            </h5>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3 offset-md-9">
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
                                <th> Language </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cookie_policy_pages['cookie_policy_pages'] as $page)
                                <tr>
                                    <td> {{ $page->title }}</td>
                                    <td> {{ $page->page_language }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm fw-bold"
                                            href="{{ route('edit.cookiepolicypages.page', $page->id) }}">
                                            <i class='bx bx-pencil'></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm fw-bold"
                                            wire:click="deleteConfirmModal({{ $page->id }})">
                                            <i class='bx bx-trash'></i>
                                        </button>
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
                        @if ($cookie_policy_pages['cookie_policy_pages']->count() > 0)
                            {{ $cookie_policy_pages['cookie_policy_pages']->links() }}
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
