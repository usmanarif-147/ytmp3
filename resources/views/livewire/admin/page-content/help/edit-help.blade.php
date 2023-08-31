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
                <form wire:submit.prevent="update">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        How to Download YouTube videos? <span class="text-danger"> * </span>
                                        @error('how_to_download_content')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <textarea class="form-control" wire:model="how_to_download_content" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Why use our Online YouTube Downloader? <span class="text-danger"> * </span>
                                        @error('why_use_content')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <textarea class="form-control" wire:model="why_use_content" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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
