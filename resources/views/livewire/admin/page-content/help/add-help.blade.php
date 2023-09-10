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
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Left Title <span class="text-danger"> * </span>
                                        @error('left_title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="left_title" class="form-control"
                                        placeholder="Enter Left Side Title">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Description <span class="text-danger"> * </span>
                                        @error('description_left')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <div wire:ignore>
                                        <textarea class="form-control" id="ck_one" wire:model.defer="description_left"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Right Title <span class="text-danger"> * </span>
                                        @error('right_title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="right_title" class="form-control"
                                        placeholder="Enter Right Side Title">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Description <span class="text-danger"> * </span>
                                        @error('description_right')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <div wire:ignore>
                                        <textarea class="form-control" id="ck_two" wire:model.defer="description_right"></textarea>
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
                .create(document.querySelector('#ck_one'), settings)
                .then(useeditor => {
                    let ckeditor;
                    ckeditor = useeditor;
                    ckeditor.model.document.on('change:data', () => {
                        console.log(ckeditor.getData())
                        @this.set('description_left', ckeditor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });


            ClassicEditor
                .create(document.querySelector('#ck_two'), settings)
                .then(sideeditor => {

                    let ckeditor;
                    ckeditor = sideeditor;
                    ckeditor.model.document.on('change:data', () => {
                        console.log(ckeditor.getData())
                        @this.set('description_right', ckeditor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endsection
