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
                        <x-custom.row label='Meta Title' required='1' property='meta_title' element=''
                            placeholder='Enter meta Title' />
                        <x-custom.row label='Meta Description' required='1' property='meta_description'
                            element='textarea' placeholder='' />

                        <x-custom.row label='Item Prop Name' required='1' property='item_prop_name' element=''
                            placeholder='Enter Item Prop Name' />
                        <x-custom.row label='Item Prop Image Url' required='1' property='item_prop_image'
                            element='' placeholder='Enter Item Prop Image Url' />
                        <x-custom.row label='Item Prop Description' required='1' property='item_prop_description'
                            element='' placeholder='Enter Item Prop Description' />

                        <x-custom.row label='Og Type' required='1' property='og_type' element=''
                            placeholder='Enter Og Type' />
                        <x-custom.row label='Og Title' required='1' property='og_title' element=''
                            placeholder='Enter Og Title' />
                        <x-custom.row label='Og Image url' required='1' property='og_image' element=''
                            placeholder='Enter Og Image url' />
                        <x-custom.row label='Og Description' required='1' property='og_description' element='textarea'
                            placeholder='Enter Og Description' />
                        <x-custom.row label='Og locale' required='1' property='og_locale' element=''
                            placeholder='Enter Og Locale' />
                        <x-custom.row label='Og url' required='1' property='og_url' element=''
                            placeholder='Enter Og Url' />
                        <x-custom.row label='canonical' required='1' property='canonical' element=''
                            placeholder='Enter Canonical' />
                        <x-custom.row label='robots' required='1' property='robots' element=''
                            placeholder='Enter Robots' />
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
    </script>
@endsection
