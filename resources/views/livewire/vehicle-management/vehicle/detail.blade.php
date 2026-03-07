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
                <label>Nama Kendaraan</label>
                <input placeholder="Nama Kendaraan" type="text" wire:model="name" class="form-control">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Nomor Polisi</label>
                <input placeholder="Nomor Polisi" type="text" wire:model="number_plate" class="form-control">

                @error('number_plate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>Jarak Tempuh Maksimal (Km)</label>
                <input placeholder="Jarak Tempuh Maksimal (Km)" type="text" wire:model="max_range" class="form-control">

                @error('max_range')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>Odometer Saat Ini (Km)</label>
                <input placeholder="Odometer Saat Ini (Km)" type="text" wire:model="current_odometer" class="form-control">

                @error('current_odometer')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>Bensin Saat Ini (Km)</label>
                <input placeholder="Bensin Saat Ini (Km)" type="text" wire:model="current_fuel" class="form-control">

                @error('current_fuel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>Saldo E Toll Saat Ini</label>
                <input placeholder="Saldo E Toll Saat Ini" type="text" wire:model="current_etoll_balance" class="form-control">

                @error('current_etoll_balance')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Foto Kendaraan</label>
                <input type="file" wire:model="image" class="form-control">

                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6 mb-3 row align-items-end">
                <div class="form-check m-2">
                    <input class="form-check-input" type="checkbox" wire:model="is_active">
                    <label class="form-label ms-2 mb-2">
                        Penanda Aktif
                    </label>
                </div>
            </div>
            <div class="col-md-6 mb-3">

                {{-- Preview --}}
                @if ($image_old)
                    <div class="row mt-3">
                        <div class="col-md-3 mb-2">
                            <img src="{{ $image_old }}" class="img-fluid rounded">
                        </div>
                    </div>
                @endif
                @if ($image)
                    <div class="row mt-3">
                        <div class="col-md-3 mb-2">
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded">
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-auto mb-3">
                <button type="button" wire:loading.attr="disabled" class="btn btn-info mt-3" wire:click="addMaintenanceByInterval()">
                    Tambah Maintenance By Interval
                </button>
            </div>
            @foreach ($maintenance_by_intervals as $index => $maintenance)
                <div class="row">
                    <div class="row col-md-10">
                        <div class="col-md-6 mb-3">
                            <label>Nama Maintenance</label>
                            <input placeholder="Nama Maintenance" type="text" wire:model="maintenance_by_intervals.{{$index}}.name" class="form-control">
    
                            @error('maintenance_by_intervals.{{$index}}.name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Notif Interval (Penggunaan)</label>
                            <input placeholder="Notif Interval (Penggunaan)" type="text" wire:model="maintenance_by_intervals.{{$index}}.notif_interval" class="form-control">
    
                            @error('maintenance_by_intervals.{{$index}}.notif_interval')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pesan Maintenance</label>
                            <input placeholder="Pesan Maintenance" type="text" wire:model="maintenance_by_intervals.{{$index}}.message" class="form-control">
    
                            @error('maintenance_by_intervals.{{$index}}.message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Interval Saat Ini (Penggunaan)</label>
                            <input placeholder="Interval Saat Ini (Penggunaan)" type="text" wire:model="maintenance_by_intervals.{{$index}}.current_interval" class="form-control">
    
                            @error('maintenance_by_intervals.{{$index}}.current_interval')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row col-md-2">

                        <div class="col-auto d-flex align-items-end">
                            <div class="form-check m-2">
                                <input class="form-check-input" type="checkbox" wire:model="maintenance_by_intervals.{{$index}}.is_show">
                                <label class="form-label ms-2 mb-2">
                                    Penanda Terlihat
                                </label>
                            </div>
                        </div>
                        <div class="col-auto mb-3 mt-3">
                            <button type="button" wire:loading.attr="disabled" class="btn btn-danger mt-3" wire:click="removeMaintenanceByInterval('{{$index}}')">
                                <i class="ki-duotone ki-trash fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <div class="row">
            <div class="col-auto mb-3">
                <button type="button" wire:loading.attr="disabled" class="btn btn-info mt-3" wire:click="addMaintenanceByOdometer()">
                    Tambah Maintenance By Odometer
                </button>
            </div>
            @foreach ($maintenance_by_odometers as $index => $maintenance)
                <div class="row">
                    <div class="row col-md-10">
                        <div class="col-md-6 mb-3">
                            <label>Nama Maintenance</label>
                            <input placeholder="Nama Maintenance" type="text" wire:model="maintenance_by_odometers.{{$index}}.name" class="form-control">
    
                            @error('maintenance_by_odometers.{{$index}}.name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Notif Odometer (Km)</label>
                            <input placeholder="Notif Odometer (Km)" type="text" wire:model="maintenance_by_odometers.{{$index}}.notif_odometer" class="form-control">
    
                            @error('maintenance_by_odometers.{{$index}}.notif_odometer')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pesan Maintenance</label>
                            <input placeholder="Pesan Maintenance" type="text" wire:model="maintenance_by_odometers.{{$index}}.message" class="form-control">
    
                            @error('maintenance_by_odometers.{{$index}}.message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Odometer Terakhir Maintenance (Km)</label>
                            <input placeholder="Odometer Terakhir Maintenance (Km)" type="text" wire:model="maintenance_by_odometers.{{$index}}.latest_odometer" class="form-control">
    
                            @error('maintenance_by_odometers.{{$index}}.latest_odometer')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row col-md-2">

                        <div class="col-auto d-flex align-items-end">
                            <div class="form-check m-2">
                                <input class="form-check-input" type="checkbox" wire:model="maintenance_by_odometers.{{$index}}.is_show">
                                <label class="form-label ms-2 mb-2">
                                    Penanda Terlihat
                                </label>
                            </div>
                        </div>
                        <div class="col-auto mb-3 mt-3">
                            <button type="button" wire:loading.attr="disabled" class="btn btn-danger mt-3" wire:click="removeMaintenanceByOdometer('{{$index}}')">
                                <i class="ki-duotone ki-trash fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mt-3">
            Save
        </button>
        

    </form>

</div>

@push('css')
    <style>

        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.2);
            /* IE */
            -moz-transform: scale(1.2);
            /* FF */
            -webkit-transform: scale(1.2);
            /* Safari and Chrome */
            -o-transform: scale(1.2);
            /* Opera */
            padding: 10px;
        }
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