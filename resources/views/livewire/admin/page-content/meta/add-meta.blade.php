<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ url('admin/pages') }}"> Pages </a> / {{ $heading }}
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Meta Title <span class="text-danger"> * </span>
                                        @error('meta_title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="meta_title" class="form-control"
                                        placeholder="Enter Meta Title">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Meta Description <span class="text-danger"> * </span>
                                        @error('meta_description')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <textarea class="form-control" wire:model="meta_description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                icon: event.detail.type,
            });
        });
    </script>
@endsection
