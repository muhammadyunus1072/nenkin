<div class="card">

    <ul class="row d-flex justify-content-evenly">
        @foreach ($vehicles as $index => $vehicle)
            <li class="col-md-4 mx-0 px-0 card mb-3">
                <div class="featured-car-card">
                <figure class="card-banner">
                    <img src="{{Storage::url($vehicle->image)}}" alt="{{$vehicle->name}}" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                </figure>
                <div class="card-content">
                    <div class="card-title-wrapper my-0 d-flex align-items-end mb-4">
                            <h2 class="card-title mb-0">
                                <i class="fa fa-car me-2" aria-hidden="true"></i>
                                {{$vehicle->name}}
                            </h2>

                            @if ($vehicle->vehicleUsageOngoing)
                                <data class="year">
                                    <p class="my-0">
                                        Dipakai Oleh :
                                        <strong>{{$vehicle->vehicleUsageOngoing->user_name}}</strong>
                                    </p>
                                </data>
                            @endif
                    </div>
                    
                        <div class="row">
                            <div class="col-auto">
                                <i class="fas fa-gas-pump"></i>
                            </div>
                            <div class="col-10 d-flex align-items-center px-0">
                                <div class="progress w-100" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    @php
                                        $fuel = ($vehicle->current_fuel/$vehicle->max_range)*100;
                                    @endphp
                                    <div class="progress-bar" style="width: {{$fuel}}%">@currency($fuel)%</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto py-0 my-0">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="col-10 d-flex align-items-center px-0 py-0 my-0">
                                <p>Rp. @currency($vehicle->current_etoll_balance)</p>
                            </div>
                        </div>

                    <div class="row d-flex justify-content-center">
                        @foreach ($vehicle->vehicleMaintenanceByIntervals as $maintenance)
                            @if ($maintenance->is_show || $maintenance->isMaintenance())
                                <div class="col-8 d-flex align-items-center gap-2 py-1 bg-danger mb-1 rounded text-dark">
                                    <i class="fas text-white fa-gear"></i>
                                
                                    <div class="maintenance-info mb-0 mt-0">
                                        @php
                                            $oil_change = $maintenance->notif_interval - $maintenance->current_interval;
                                            $oil = $oil_change < 0 ? 0 : $oil_change;
                                        @endphp
                                        <span class="text-white">@currency($oil) Penggunaan lagi {{$maintenance->message}} </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach ($vehicle->vehicleMaintenanceByOdometers as $maintenance)
                            @if ($maintenance->is_show || $maintenance->isMaintenance())
                                <div class="col-8 d-flex align-items-center gap-2 py-1 bg-danger mb-1 rounded text-dark">
                                    <i class="fas text-white fa-gear"></i>
                                    <div class="maintenance-info mb-0 mt-0">
                                        @php
                                            $oil_change = $maintenance->notif_odometer - ($vehicle->current_odometer - $maintenance->latest_odometer);
                                            $oil = $oil_change < 0 ? 0 : $oil_change;
                                        @endphp
                                        <span class="text-white">@currency($oil) Km Lagi {{$maintenance->message}}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if ($vehicle->vehicleBookingActives->toArray())
                    <div class="card bg-light rounded p-3">
                        <div class="booking-list-title">Jadwal Booking:</div>

                        <ul class="card-list">
                            @foreach ($vehicle->vehicleBookingActives as $ibooking => $booking)   
                                <li class="card-list-item">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="card-item-text ">{{$booking->user_name}}</span>
                                </li>
                                <li class="card-list-item">
                                    <span class="card-item-text" style="font-size: 7pt;">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y') }}
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} 
                                        @if ($booking->estimated_end_time)
                                            - <br>
                                            {{ \Carbon\Carbon::parse($booking->estimated_end_time)->format('d/m/Y') }}
                                            {{ \Carbon\Carbon::parse($booking->estimated_end_time)->format('H:i') }} 
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <div class="row">
                        <p class="bg-light rounded p-3">Belum ada jadwal booking.</p>
                    </div>
                    @endif
                    <div class="row d-flex justify-content-center gap-2">
                        <div class="col-10 row d-flex justify-content-center gap-2">
                            <div class="mx-0 px-0 col-auto">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookingModal" wire:click="openBooking('{{$vehicle->id}}')">
                                    <i class="fas fa-calendar-plus"></i>
                                    Booking
                                </button>
                            </div>
                            @if (!$vehicle->vehicleUsageOngoing && !$ongoing_vehicle)
                                <div class="mx-0 px-0 col-auto">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startModal" wire:click="openStart('{{$vehicle->id}}')">
                                        <i class="fas fa-play"></i>
                                        Mulai
                                    </button>
                                </div>
                            @endif
                            @if ($vehicle->vehicleUsageOngoing)
                                @if ($vehicle->vehicleUsageOngoing->user_id === auth()->user()->id)
                                    <div class="mx-0 px-0 col-auto">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endModal" wire:click="openDone('{{$vehicle->id}}', '{{$vehicle->vehicleUsageOngoing->id}}')">
                                            <i class="fas fa-stop"></i> 
                                            Selesai
                                        </button>
                                    </div>
                                @else
                                <div class="mx-0 px-0 col-auto">
                                    
                                    <a target="_BLANK" href="https://wa.me/62{{$vehicle->vehicleUsageOngoing->user->phone}}" class="btn btn-success" >
                                        <i class="fas fa-mail"></i> 
                                        Kirim WA
                                    </a>
                                    <a href="https://www.google.com/maps?q={{$vehicle->lat}},{{$vehicle->lng}}" target="_BLANK" class="btn btn-success">
                                        <i class="fa fa-map-marker"></i>
                                        Map
                                    </a>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="row row mt-3 d-flex justify-content-center px-2">
                        <div class="col-10 mx-0 px-0 row d-flex justify-content-center gap-2">
                            <div class="mx-0 px-0 col-auto">
                                <button type="button" class="btn btn-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#maintenanceModal" wire:click="openMaintenance('{{$vehicle->id}}')">
                                    <i class="fas fa-gear"></i>
                                    Maintenance
                                </button>
                            </div>
                            @if ($vehicle->isNeedMaintenance())
                                <div class="mx-0 px-0 col-auto">
                                    <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#serviceModal" wire:click="openMaintenance('{{$vehicle->id}}')">
                                        Servis
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Service Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="serviceModalLabel">Service</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($vehicle_maintenance)
                    <div class="row px-0 mx-0">
                        <div class="row px-0 mx-0">
                            <div class="col-5 d-flex align-items-center">
                                {{-- Preview --}}
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($vehicle_maintenance->image) }}" class="img-fluid rounded">
                            </div>
                            <div class="col-7 row px-0 mx-0">
                                <div class="col-6 mb-3">
                                    <label>Nama Mobil</label>
                                    <p class="form-control">{{$vehicle_maintenance->name}}</p>
                                </div>
    
                                <div class="col-6 mb-3">
                                    <label>Nomor Polisi</label>
                                    <p class="form-control">{{$vehicle_maintenance->number_plate}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Jarak Tempuh (Km)</label>
                                    <p class="form-control">{{$vehicle_maintenance->max_range}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Odometer Terakhir (Km)</label>
                                    <p class="form-control">{{$vehicle_maintenance->current_odometer}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Km Awal</th>
                                    <th scope="col">Km Servis</th>
                                    <th scope="col">Km Sekarang</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($vehicle_maintenance_odometers)
                                        @foreach ($vehicle_maintenance_odometers as $odo_index => $odomain)
                                            <tr wire:key="interval-{{$odomain['id']}}">
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$odomain['name']}}</td>
                                                <td>{{$odomain['latest_odometer']}}</td>
                                                <td>{{$odomain['notif_odometer']}}</td>
                                                <td>{{$maintenance_current_odometer}}</td>
                                                
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Interval Servis</th>
                                    <th scope="col">Interval Sekarang</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($vehicle_maintenance_intervals)
                                        @foreach ($vehicle_maintenance_intervals as $int_index => $intmain)
                                            <tr wire:key="interval-{{$intmain['id']}}">
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$intmain['name']}}</td>
                                                <td>{{$intmain['notif_interval']}}</td>
                                                <td>{{$intmain['current_interval']}}</td>
                                                
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Maintenance Modal -->
    <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-labelledby="maintenanceModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="maintenanceModalLabel">Maintenance</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($vehicle_maintenance)
                    <div class="row px-0 mx-0">
                        <div class="row px-0 mx-0">
                            <div class="col-5 d-flex align-items-center">
                                {{-- Preview --}}
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($vehicle_maintenance->image) }}" class="img-fluid rounded">
                            </div>
                            <div class="col-7 row px-0 mx-0">
                                <div class="col-6 mb-3">
                                    <label>Nama Mobil</label>
                                    <p class="form-control">{{$vehicle_maintenance->name}}</p>
                                </div>
    
                                <div class="col-6 mb-3">
                                    <label>Nomor Polisi</label>
                                    <p class="form-control">{{$vehicle_maintenance->number_plate}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Jarak Tempuh (Km)</label>
                                    <p class="form-control">{{$vehicle_maintenance->max_range}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Odometer Terakhir (Km)</label>
                                    <p class="form-control">{{$vehicle_maintenance->current_odometer}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <label>Input Odometer Saat Ini (Km)</label>
                                <input type="text" class="form-control" placeholder="Input Odometer Saat Ini (Km)" wire:model.live="maintenance_current_odometer" required>
                                
                                @error('maintenance_current_odometer')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Km Awal</th>
                                    <th scope="col">Km Servis</th>
                                    <th scope="col">Km Sekarang</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($vehicle_maintenance_odometers)
                                        @foreach ($vehicle_maintenance_odometers as $odo_index => $odomain)
                                            <tr wire:key="interval-{{$odomain['id']}}">
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$odomain['name']}}</td>
                                                <td>{{$odomain['latest_odometer']}}</td>
                                                <td>{{$odomain['notif_odometer']}}</td>
                                                <td>{{$maintenance_current_odometer}}</td>
                                                <td>
                                                    <input type="checkbox" wire:model="vehicle_maintenance_odometers.{{$odo_index}}.is_checked">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Interval Servis</th>
                                    <th scope="col">Interval Sekarang</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($vehicle_maintenance_intervals)
                                        @foreach ($vehicle_maintenance_intervals as $int_index => $intmain)
                                            <tr wire:key="interval-{{$intmain['id']}}">
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$intmain['name']}}</td>
                                                <td>{{$intmain['notif_interval']}}</td>
                                                <td>{{$intmain['current_interval']}}</td>
                                                <td>
                                                    <input type="checkbox" wire:model="vehicle_maintenance_intervals.{{$int_index}}.is_checked">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="saveMaintenance">Simpan</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bookingModalLabel">Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tujuan</label>
                        <input placeholder="Tujuan" type="text" wire:model="destination" class="form-control">

                        @error('destination')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Keperluan</label>
                        <textarea class="form-control" wire:model="purpose" placeholder="Keperluan" rows="3"></textarea>

                        @error('purpose')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Waktu Penggunaan</label>
                        <input type="datetime-local" class="form-control" wire:model="start_time">

                        @error('start_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Estimasi Waktu Selesai (Optional)</label>
                        <input type="datetime-local" class="form-control" wire:model="estimated_end_time">

                        @error('estimated_end_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="saveBooking">Simpan</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Start Modal -->
    <div class="modal fade" id="startModal" tabindex="-1" aria-labelledby="startModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bookingModalLabel">Mulai Pakai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Cek</label>
                        <p class="form-control">{{\Carbon\Carbon::now()->translatedFormat('d F Y')}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nama Pengguna</label>
                        <p class="form-control">{{auth()->user()->name}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kondisi Ban</label>
                        <br>
                        @foreach($tire_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="start_tire_condition" value="{{ $value }}" id="start_tire_{{ $value }}">
                            
                            <label 
                                for="start_tire_{{ $value }}"
                                class="{{ $start_tire_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kondisi Lampu</label>
                        <br>
                        @foreach($light_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="start_light_condition" value="{{ $value }}" id="start_light_{{ $value }}">
                            
                            <label 
                                for="start_light_{{ $value }}"
                                class="{{ $start_light_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kebersihan Interior</label>
                        <br>
                        @foreach($interior_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="start_interior_condition" value="{{ $value }}" id="start_interior_{{ $value }}">
                            
                            <label 
                                for="start_interior_{{ $value }}"
                                class="{{ $start_interior_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kebersihan Exterior</label>
                        <br>
                        @foreach($exterior_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="start_exterior_condition" value="{{ $value }}" id="start_exterior_{{ $value }}">
                            
                            <label 
                                for="start_exterior_{{ $value }}"
                                class="{{ $start_exterior_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kilometer Awal</label>
                        <input type="text" class="form-control" wire:model="start_odometer" placeholder="Kilometer Awal">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Bensin Awal (dari sistem)</label>
                        <input type="text" class="form-control" wire:model="start_fuel" placeholder="Bensin Awal (dari sistem)">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Saldo Awal E-Toll</label>
                        <input type="text" class="form-control" wire:model="start_etoll_balance" placeholder="Saldo Awal E-Toll">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="saveStart">Simpan</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <div class="modal fade" id="endModal" tabindex="-1" aria-labelledby="endModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bookingModalLabel">Selesai Pakai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Cek</label>
                        <p class="form-control">{{\Carbon\Carbon::now()->translatedFormat('d F Y')}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nama Pengguna</label>
                        <p class="form-control">{{auth()->user()->name}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kondisi Ban</label>
                        <br>
                        @foreach($tire_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="end_tire_condition" value="{{ $value }}" id="end_tire_{{ $value }}">
                            
                            <label 
                                for="end_tire_{{ $value }}"
                                class="{{ $end_tire_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kondisi Lampu</label>
                        <br>
                        @foreach($light_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="end_light_condition" value="{{ $value }}" id="end_light_{{ $value }}">
                            
                            <label 
                                for="end_light_{{ $value }}"
                                class="{{ $end_light_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kebersihan Interior</label>
                        <br>
                        @foreach($interior_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="end_interior_condition" value="{{ $value }}" id="end_interior_{{ $value }}">
                            
                            <label 
                                for="end_interior_{{ $value }}"
                                class="{{ $end_interior_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kebersihan Exterior</label>
                        <br>
                        @foreach($exterior_condition_options as $value => $label)
                            <input type="radio" class="btn-check" wire:model.live="end_exterior_condition" value="{{ $value }}" id="end_exterior_{{ $value }}">
                            
                            <label 
                                for="end_exterior_{{ $value }}"
                                class="{{ $end_exterior_condition == $value ? 'btn btn-primary' : 'btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4' }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kilometer Akhir</label>
                        <input type="text" class="form-control" wire:model="end_odometer" placeholder="Kilometer Akhir">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Bensin Akhir (dari sistem)</label>
                        <input type="text" class="form-control" wire:model="end_fuel" placeholder="Bensin Akhir (dari sistem)">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Saldo Akhir E-Toll</label>
                        <input type="text" class="form-control" wire:model="end_etoll_balance" placeholder="Saldo Akhir E-Toll">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="saveEnd">Simpan</button>
            </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    {{-- CARD  --}}
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans:wght@400;600&display=swap');
        
         /* layout */
         .featured-car-list{
         display:grid;
         grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
         gap:25px;
         list-style:none;
         }
         /* card */
         .featured-car-card{
         background:var(--gradient);
         border-radius:var(--radius-18);
         padding:10px;
         box-shadow:var(--shadow-1);
         }
         .card-banner{
         aspect-ratio:3/2;
         border-radius:var(--radius-18);
         overflow:hidden;
         }
         .card-banner img{
         width:100%;
         height:100%;
         object-fit:cover;
         }
         .card-content{
         padding:20px 10px 10px;
         }
         .card-title-wrapper{
         display:flex;
         justify-content:space-between;
         align-items:center;
         margin-bottom:15px;
         }
         .card-title{
         font-family:var(--ff-nunito);
         color:var(--space-cadet);
         }
         .card-title a{
         text-decoration:none;
         color:inherit;
         }
         .year{
         font-size:12px;
         padding:3px 12px;
         border:2px dashed rgba(0,0,0,0.2);
         border-radius:var(--radius-14);
         }
         .card-list{
         display:grid;
         grid-template-columns:1fr 1fr;
         gap:10px;
         padding-bottom:15px;
         border-bottom:1px solid rgba(0,0,0,0.1);
         margin-bottom:15px;
         list-style:none;
         }
         .card-list-item{
         display:flex;
         align-items:center;
         gap:6px;
         font-size:13px;
         color:var(--independence);
         }
         .card-list-item ion-icon{
         font-size:18px;
         color:var(--carolina-blue);
         }
         .card-price-wrapper{
         display:flex;
         justify-content:space-between;
         align-items:center;
         gap:10px;
         }
         .card-price{
         font-size:14px;
         }
         .card-price strong{
         font-size:20px;
         }
         .btn{
         border:none;
         background:var(--carolina-blue);
         color:white;
         padding:8px 16px;
         border-radius:10px;
         cursor:pointer;
         }
         .fav-btn{
         border:0;
         border-radius: 15px;
         background:var(--beau-blue);
         color:var(--carolina-blue);
         width:36px;
         height:36px;
         display:flex;
         align-items:center;
         justify-content:center;
         }
         .fav-btn:hover{
         background:var(--lavender-blush);
         color:var(--red-salsa);
         }
         
    </style>
    <style>
        .btn.btn-icon{
            background-color: white;
        }
        .progress{
            background-color: rgb(202, 220, 220);
        }
        .progress-bar{
            border-radius: 6px;
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

@push('js')
<script>
setInterval(() => {
    navigator.geolocation.getCurrentPosition(
        function(position) {

            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            // @this.call('setLocation', lat, lng);

        },
        function(error) {
            // @this.call('showDeniedLocation');
        },
        {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 10000
        }
    );
}, 5000);
</script>
@endpush