<div>
    <div wire.loading
     class="position-fixed top-0 start-0 w-100 h-100 
            bg-dark bg-opacity-50 
            justify-content-center align-items-center"
     style="z-index:9999;">

    <div class="bg-white p-4 rounded shadow">
        <p class="text-dark" style="font-size: 1.5rem; width: 100%; text-align: center;"> 
                        <i class="text-dark animate-wand fas fa-wand-magic-sparkles text-dark"></i> &nbsp; Sedang Memproses
                    </p>
    </div>
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

            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mt-3">
                Save
            </button>
        

    </form>

</div>

@push('css')
    <style>
        @keyframes pulse-wand {
            0%   { transform: scale(1);   opacity: 1; }
            50%  { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1);   opacity: 1; }
        }

        .animate-wand {
            animation: pulse-wand 1s infinite ease-in-out;
        }
    </style>
@endpush