<div>
    
    <form wire:submit.prevent="store">
        <div class="position-relative">
            
            <div wire:loading >
                <div class="position-absolute w-100 h-100">
                    <div class="w-100 h-100" style="background-color: grey; opacity:0.2"></div>
                </div>
                    <span wire:loading class="text-white indicator-progress" wire:target="images"> <i wire:loading class="text-white indicator-progress animate-wand fas fa-wand-magic-sparkles text-white"></i> &nbsp; Sedang Memproses
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