<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ route('pages') }}"> Pages </a> / {{ $heading }}
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
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        @if ($feature_image && !is_string($feature_image))
                                            <img src="{{ $feature_image->temporaryUrl() }}" alt="user-avatar"
                                                class="d-block rounded" height="200" width="170">
                                        @else
                                            <img src="{{ asset(isImageExist('frame_2.webp')) }}" alt="user-avatar"
                                                class="d-block rounded" height="200" width="170">
                                        @endif
                                        <div wire:loading wire:target="feature_image" wire:key="feature_image">
                                            <i class="fa fa-spinner fa-spin mt-2 ml-2"></i>
                                        </div>

                                        <div class="icon-upload btn btn-primary">
                                            <span>Upload Feature Icon</span>
                                            <input type="file" class="icon-input" wire:model="feature_image"
                                                accept="image/png, image/jpeg, image/jpg, image/webp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Feature Title <span class="text-danger"> * </span>
                                        @error('feature_title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="feature_title" class="form-control"
                                        placeholder="Enter Feature Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Feature Description <span class="text-danger"> * </span>
                                        @error('feature_description')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <div wire:ignore>
                                        <textarea class="form-control" id="ck_feature" wire:model.defer="feature_description"></textarea>
                                    </div>
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
                allowOutsideClick: false,
            }).then(() => {
                location.href = "{{ route('pages') }}";
            });
        });

        let settings = ck_settings();

        document.addEventListener("DOMContentLoaded", function() {

            ClassicEditor
                .create(document.querySelector('#ck_feature'), settings)
                .then(useeditor => {
                    let ckeditor;
                    ckeditor = useeditor;
                    ckeditor.model.document.on('change:data', () => {
                        console.log(ckeditor.getData())
                        @this.set('feature_description', ckeditor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endsection
