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
                            <div class="col-6">
                                @error('item_prop_image')
                                    <span class="text-danger error-message">{{ $message }}</span>
                                @enderror
                                <div class="d-flex align-items-start align-items-sm-center gap-4">

                                    @if ($item_prop_image && !is_string($item_prop_image))
                                        <img src="{{ $item_prop_image->temporaryUrl() }}" alt="user-avatar"
                                            class="d-block rounded" height="200" width="170">
                                    @else
                                        <img src="{{ asset(isImageExist($item_prop_image_preview)) }}" alt="user-avatar"
                                            class="d-block rounded" height="200" width="170">
                                    @endif

                                    <div wire:loading wire:target="item_prop_image" wire:key="item_prop_image">
                                        <i class="fa fa-spinner fa-spin mt-2 ml-2"></i>
                                    </div>
                                    <div class="icon-upload btn btn-primary">
                                        <span>Upload Item Prop Image</span>
                                        <input type="file" class="icon-input" wire:model="item_prop_image"
                                            accept="image/png, image/jpeg, image/jpg, image/gif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                @error('og_image')
                                    <span class="text-danger error-message">{{ $message }}</span>
                                @enderror
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($og_image && !is_string($og_image))
                                        <img src="{{ $og_image->temporaryUrl() }}" alt="user-avatar"
                                            class="d-block rounded" height="200" width="170">
                                    @else
                                        <img src="{{ asset(isImageExist($og_image_preview)) }}" alt="user-avatar"
                                            class="d-block rounded" height="200" width="170">
                                    @endif

                                    <div wire:loading wire:target="og_image" wire:key="og_image">
                                        <i class="fa fa-spinner fa-spin mt-2 ml-2"></i>
                                    </div>
                                    <div class="icon-upload btn btn-primary">
                                        <span>Upload Og Image</span>
                                        <input type="file" class="icon-input" wire:model="og_image"
                                            accept="image/png, image/jpeg, image/jpg, image/gif">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Robots <span class="text-danger"> * </span>
                                        @error('robots')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="robots" class="form-control"
                                        placeholder="Enter Robots">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Item Prop Name <span class="text-danger"> * </span>
                                        @error('item_prop_name')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="item_prop_name" class="form-control"
                                        placeholder="Enter Item Prop Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Canonical <span class="text-danger"> * </span>
                                        @error('canonical')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="canonical" class="form-control"
                                        placeholder="Enter Canonical">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Og type <span class="text-danger"> * </span>
                                        @error('og_type')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="og_type" class="form-control"
                                        placeholder="Enter Og Type">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Og title <span class="text-danger"> * </span>
                                        @error('og_title')
                                            <span class="text-danger error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" wire:model="og_title" class="form-control"
                                        placeholder="Enter Og Title">
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
