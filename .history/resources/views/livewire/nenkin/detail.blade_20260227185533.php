<div>
    
    <form wire:submit.prevent="store">
<div wire:loading>
            <div class="position-absolute w-100 h-100">
                <div class="w-100 h-100" style="background-color: grey; opacity:0.2"></div>
            </div>
            <h5 class="position-absolute shadow bg-white p-2 rounded"
                style="top: 50%;left: 50%;transform: translate(-50%, -50%);">Loading...</h5>
        </div>
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