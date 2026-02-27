<div>
    
    <form wire:submit.prevent="store">
        <div class="position-relative">
            <div class="position-absolute border border-danger" style="top: 0; left: 0; right: 0; bottom: 0; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.8); z-index: 10;">
                    <span class="text-white indicator-progress" style="font-size: 1.5rem; width: 100%; text-align: center;"> 
                        <i class="text-white indicator-progress animate-wand fas fa-wand-magic-sparkles text-white"></i> &nbsp; Sedang Memproses
                </span>
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