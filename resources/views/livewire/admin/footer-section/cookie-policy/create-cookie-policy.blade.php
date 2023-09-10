<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ route('cookiepolicypages') }}"> Cookie Policy Pages </a> / {{ $heading }}
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Language <span class="text-danger"> * </span>
                                        @error('lang_id')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <select class="form-select" wire:model="lang_id">
                                        <option value="0" selected="">Select Language</option>
                                        @foreach ($languages as $id => $lang)
                                            <option value="{{ $id }}">
                                                {{ $lang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Title <span class="text-danger"> * </span>
                                        @error('title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="title" class="form-control"
                                        placeholder="Enter Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Description <span class="text-danger"> * </span>
                                        @error('description')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <div wire:ignore>
                                        <textarea class="form-control" id="description" wire:model.defer="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" {{ $formSubmited ? 'disabled' : '' }}>
                            Save
                        </button>
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
                allowOutsideClick: false,
            }).then(() => {
                location.href = "{{ route('cookiepolicypages') }}";
            });
        });

        let settings = ck_settings();

        document.addEventListener("DOMContentLoaded", function() {

            ClassicEditor
                .create(document.querySelector('#description'), settings)
                .then(useeditor => {
                    let ckeditor;
                    ckeditor = useeditor;
                    ckeditor.model.document.on('change:data', () => {
                        @this.set('description', ckeditor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endsection
