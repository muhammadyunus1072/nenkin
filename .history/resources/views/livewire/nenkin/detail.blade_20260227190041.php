<div>
    
    <form wire:submit.prevent="store">
        <div class="position-relative">
            <div wire:loading.flex 
     wire:target="images"
     class="position-fixed top-0 start-0 w-100 h-100 
            bg-dark bg-opacity-50 
            justify-content-center align-items-center"
     style="z-index:9999;">

    <div class="bg-white p-4 rounded shadow">
        <div class="spinner-border text-primary"></div>
        <div class="mt-2">Processing, please wait...</div>
    </div>
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

            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mt-3">
                Save
            </button>
        </div>

    </form>

</div>