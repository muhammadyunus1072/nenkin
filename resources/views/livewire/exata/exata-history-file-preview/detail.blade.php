<div>

    <form wire:submit.prevent="store">
        
    <div wire:loading wire:target="images, store"
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
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Keterangan</label>
                <input placeholder="Keterangan" type="text" wire:model="description" class="form-control">

                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>File</label>
                <input type="file" class="form-control" wire:model="file">

                @error('file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
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