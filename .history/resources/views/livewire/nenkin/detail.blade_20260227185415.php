<div>
<div wire:loading class="text-primary mt-2">
        Uploading file...
    </div>
    <form wire:submit.prevent="store">

        <div class="mb-3">
            <label>Images</label>
            <input type="file" wire:model="images" multiple class="form-control">

            @error('images.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Preview --}}
        <div class="row mt-3">
            @foreach ($images as $image)
                <div class="col-md-3 mb-2">
                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Save
        </button>

    </form>

</div>