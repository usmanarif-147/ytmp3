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
                    @foreach ($questions as $index => $question)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Question : {{ $index + 1 }} <span class="text-danger"> * </span>
                                                    @error('questions.' . $index)
                                                        <span class="text-danger error-message">{{ $message }}</span>
                                                    @enderror
                                                </label>
                                                <textarea class="form-control" wire:model.defer="questions.{{ $index }}" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Answer <span class="text-danger"> * </span>
                                                    @error('answers.' . $index)
                                                        <span class="text-danger error-message">{{ $message }}</span>
                                                    @enderror
                                                </label>
                                                <textarea class="form-control" wire:model.defer="answers.{{ $index }}" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($index)
                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-danger"
                                                    wire:click="removeFaq({{ $index }})">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="card-footer">
                        <button type="button" class="btn btn-success" wire:click="addNewFaq">Add</button>
                        @if (count($questions))
                            <button type="submit" class="btn btn-primary">Save</button>
                        @endif
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

        // $(document).on('click', '.swal-button', function() {
        //     location.href = "{{ route('pages') }}";
        // });
    </script>
@endsection
