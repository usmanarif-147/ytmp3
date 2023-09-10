<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">
                {{ $label }}
                @if ($required)
                    <span class="text-danger"> * </span>
                @endif
                @error($property)
                    <span class="text-danger error-message">{{ $message }}</span>
                @enderror
            </label>
            @if ($element == 'textarea')
                <textarea class="form-control" wire:model="{{ $property }}"></textarea>
            @else
                <input type="text" wire:model="{{ $property }}" class="form-control"
                    placeholder="{{ $placeholder }}">
            @endif
        </div>
    </div>
</div>
