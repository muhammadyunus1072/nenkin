<div>
        @foreach ($vehicles as $index => $vehicle)
                <div class="car-image-container">
                    
                    <img src="{{Storage::url($vehicle->image)}}" alt="" class="img w-100 h-100">
                </div>
                <div class="car-header"><i class="fas fa-car-side fa-lg text-primary"></i><h2>{{$vehicle->name}}</h2></div>
                <div class="car-header">
                    <a target="_blank" href="https://www.google.com/maps?q={{$vehicle->lat}},{{$vehicle->lng}}">
                        <p class="card-meta text-primary mb-5 mb-xl-0 mb-md-0"><i class="fa-solid fa-location-dot text-primary pe-3"></i>Lihat Lokasi Terkini</p>
                    </a>
                </div>
                {{-- <h2>{{dd($vehicle->lastVehicleUsageEnd->user_name)}}</h2> --}}
                {{-- @if ($vehicle->lastVehicleUsage)
                    <div class="fuel-container">
                        <i class="fas fa-gas-pump fuel-icon text-primary"></i>
                        <div class="fuel-bar-background">
                            <div class="fuel-bar-percentage" 
                            style="width: {{App\Helpers\VehicleHelper::fuelPercentage($vehicle->max_range, $vehicle->lastVehicleUsage->end_fuel)}}%;">
                            {{number_format(App\Helpers\VehicleHelper::fuelPercentage($vehicle->max_range, $vehicle->lastVehicleUsageEnd->end_fuel), 2, ',', '.')}}%
                            </div>
                        </div>
                    </div>
                @endif --}}

                @foreach ($vehicle->vehicleMaintenanceByIntervals as $maintenance)
                    @if ($maintenance->notif_interval <= $maintenance->current_interval)
                        <div class="maintenance-info mb-0 mt-0">
                            <span class="text-white">{{$maintenance->message}}</span>
                        </div>
                    @endif
                @endforeach
                @foreach ($vehicle->vehicleMaintenanceByOdometers as $maintenance)
                    @if ($maintenance->notif_odometer <= ($vehicle->current_odometer - $maintenance->latest_odometer))
                        <div class="maintenance-info mb-0 mt-0">
                            <span class="text-white">{{$maintenance->message}}</span>
                        </div>
                    @endif
                @endforeach
                

                <div class="status-section">
                    @if ($vehicle->vehicleUsageOngoing)
                        <div class="fs-1 text-danger">Dipakai oleh: {{$vehicle->vehicleUsageOngoing->user_name}}</div>
                    @endif
                    @if ($vehicle->vehicleBookingActives->toArray())
                        <div class="booking-list-title">Jadwal Booking:</div>
                        <ul class="booking-list">
                            @foreach ($vehicle->vehicleBookingActives as $ibooking => $booking)
                                <li>
                                    <span class="user-name" style="font-weight:600;">
                                        {{$booking->user_name}}
                                    </span>
                                    <span class="time-info" style="text-align:right; font-size:0.8rem;">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y') }}
                                        Jam {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} 
                                        @if ($booking->estimated_end_time)
                                            - 
                                            {{ \Carbon\Carbon::parse($booking->estimated_end_time)->format('d/m/Y') }}
                                            Jam {{ \Carbon\Carbon::parse($booking->estimated_end_time)->format('H:i') }} 
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="no-booking">Belum ada jadwal booking.</p>
                    @endif
                </div>
                <div class="button-group d-flex justify-content-center">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookingModal" wire:click="openBooking('{{$vehicle->id}}')">
                        <i class="fas fa-calendar-plus"></i>
                         Booking
                    </button>
                    @if (!$vehicle->vehicleUsageOngoing && !$ongoing_vehicle)
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startModal" wire:click="openStart('{{$vehicle->id}}')">
                            <i class="fas fa-play"></i>
                            Mulai Pakai
                        </button>
                    @endif
                    @if ($vehicle->vehicleUsageOngoing)
                        @if ($vehicle->vehicleUsageOngoing->user_id === auth()->user()->id)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endModal" wire:click="openDone('{{$vehicle->id}}', '{{$vehicle->vehicleUsageOngoing->id}}')">
                                <i class="fas fa-stop"></i> 
                                Selesai
                            </button>
                        @else
                            <a target="_BLANK" href="https://wa.me/62{{$vehicle->vehicleUsageOngoing->user->phone}}" class="btn btn-success" >
                                <i class="fas fa-mail"></i> 
                                Kirim Pesan
                            </a>
                        @endif
                    @else
                    @endif
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <button type="button" class="btn btn-info w-75" data-bs-toggle="modal" data-bs-target="#maintenanceModal" wire:click="openMaintenance('{{$vehicle->id}}')">
                        <i class="fas fa-gear"></i>
                         Maintenance
                    </button>
                </div>
            
        @endforeach

    </form>

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
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Kendaraan</label>
                                <p class="form-control">{{$vehicle_maintenance->name}}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Nomor Polisi</label>
                                <p class="form-control">{{$vehicle_maintenance->number_plate}}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jarak Tempuh Maksimal (Km)</label>
                                <p class="form-control">{{$vehicle_maintenance->max_range}}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Odometer Saat Ini (Km)</label>
                                <p class="form-control">{{$vehicle_maintenance->current_odometer}}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Foto Kendaraan</label>
                                {{-- Preview --}}
                                <div class="row">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($vehicle_maintenance->image) }}" class="img-fluid rounded">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <label>Odometer Saat Ini (Km)</label>
                                <input type="text" class="form-control" placeholder="Odometer Saat Ini (Km)" wire:model="maintenance_current_odometer" required>
                                
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
                                    <th scope="col">Nama Maintenance</th>
                                    <th scope="col">Notif Interval</th>
                                    <th scope="col">Interval Saat Ini</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicle_maintenance_intervals as $int_index => $maintenance)
                                        <tr>
                                            <th scope="row">{{$index+=1}}</th>
                                            <td>{{$maintenance['name']}}</td>
                                            <td>{{$maintenance['notif_interval']}}</td>
                                            <td>{{$maintenance['current_interval']}}</td>
                                            <td>
                                                <input type="checkbox" wire:model="vehicle_maintenance_intervals.{{$int_index}}.is_checked">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Maintenance</th>
                                    <th scope="col">Notif Odometer</th>
                                    <th scope="col">Servis Terakhir</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicle_maintenance_odometers as $odo_index => $maintenance)
                                        <tr>
                                            <th scope="row">{{$index+=1}}</th>
                                            <td>{{$maintenance['name']}}</td>
                                            <td>{{$maintenance['notif_odometer']}}</td>
                                            <td>{{$maintenance['latest_odometer']}}</td>
                                            <td>
                                                <input type="checkbox" wire:model="vehicle_maintenance_odometers.{{$odo_index}}.is_checked">
                                            </td>
                                        </tr>
                                    @endforeach
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
        :root {
            --primary-blue: #005A9C; 
            --accent-blue: #3498db; 
            --accent-green: #2ecc71;
            --light-gray: #f4f7f6; /* Latar abu-abu sangat terang */
            --dark-gray: #7f8c8d; 
            --bg-white: #ffffff; /* Latar utama putih */
            --text-color: #2c3e50; /* Teks warna gelap */
            --border-color: #e0e0e0;
            --shadow-soft: 0 8px 25px rgba(0, 90, 156, 0.08);
            --shadow-hover: 0 12px 30px rgba(0, 90, 156, 0.15);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--light-gray); color: var(--text-color); display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; padding: 20px; }

        #login-section { display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 80vh; width: 100%; max-width: 400px; margin: 0 auto; }
        .login-card { background: var(--bg-white); padding: 40px 30px; border-radius: 20px; box-shadow: var(--shadow-soft); width: 100%; text-align: center; border: 1px solid var(--border-color); }
        .login-card h2 { color: var(--primary-blue); margin-bottom: 25px; font-weight: 700; font-size: 1rem;}
		.login-logo {
            width: 100px; 
            height: auto;
            margin-bottom: 15px;
            border-radius: 10px; 
            object-fit: contain;
        }
        .password-wrapper { position: relative; }
        .password-toggle { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--dark-gray); transition: color 0.3s; }
        .password-toggle:hover { color: var(--primary-blue); }
        
        #loading-screen { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--bg-white); display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 9999; transition: opacity 0.5s ease; }
        .loader-spinner { width: 50px; height: 50px; border: 5px solid var(--light-gray); border-top: 5px solid var(--primary-blue); border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        .main-container { width: 100%; max-width: 500px; opacity: 0; transform: translateY(20px); animation: fadeIn 0.8s ease-out forwards; }
        @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
        
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 15px; }
        header h1 { color: var(--primary-blue); font-size: 1.8rem; font-weight: 700; margin: 0; }
		.header-logo {
		    height: 20px; /* Anda bisa mengubah angka ini (misal 30px atau 50px) sesuai selera */
		    width: auto;
		    object-fit: contain;
		}
        .btn-logout { background: none; border: none; color: #e74c3c; cursor: pointer; font-weight: 600; font-size: 1rem; font-family: 'Poppins', sans-serif; display: flex; align-items: center; gap: 5px; transition: color 0.3s; }
        .btn-logout:hover { color: #c0392b; }

        .car-card { background-color: var(--bg-white); border-radius: 15px; padding: 20px; margin-bottom: 20px; box-shadow: var(--shadow-soft); border: 1px solid var(--border-color); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .car-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
        .car-image-container {
            <img src="" alt=""> height: 120px; border-radius: 10px; margin-bottom: 15px; background-size: cover; background-position: center; border: 1px solid var(--border-color); }
        .car-card[data-car-name="Avanza KZU"] .car-image-container { background-image: url('https://yanoshijapan.github.io/asetonline/kzu.jpg'); }
        .car-card[data-car-name="Innova KFV"] .car-image-container { background-image: url('https://yanoshijapan.github.io/asetonline/kfv.jpg'); }
        .car-header { display: flex; align-items: center; gap: 15px; font-size: 1.5rem; font-weight: 600; color: var(--primary-blue); }
        .car-header i { color: var(--accent-blue); }
        
        .fuel-container { margin-top: 15px; display: flex; align-items: center; gap: 10px; }
        .fuel-icon { font-size: 1.5rem; color: var(--accent-blue); }
        .fuel-bar-background { flex-grow: 1; height: 20px; background-color: var(--border-color); border-radius: 10px; overflow: hidden; }
        .fuel-bar-percentage { height: 100%; width: 0%; background: linear-gradient(90deg, var(--accent-blue), var(--primary-blue)); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.8rem; transition: width 1s cubic-bezier(0.25, 1, 0.5, 1); }
        
        .maintenance-info { margin-top: 15px; padding: 10px; background-color: #c84132; border-radius: 8px; text-align: center; font-size: 0.9rem; font-weight: 600; color: var(--primary-blue); display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid #d1eaf5; }
        .status-section { margin-top: 15px; }
        .current-status { font-size: 1.1rem; font-weight: 600; margin-bottom: 10px; padding-top: 15px; border-top: 1px solid var(--border-color); }
        .status-available { color: var(--accent-green); }
        .status-in-use { color: #e74c3c; }
        .status-booked { color: #f39c12; }
        
        .booking-list-title { font-size: 0.9rem; font-weight: 600; color: var(--dark-gray); margin-bottom: 5px; }
        .booking-list { list-style: none; padding-left: 5px; max-height: 150px; overflow-y: auto; }
        .booking-list li { font-size: 0.9rem; padding: 8px 5px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; color: var(--text-color); }
        .no-booking { font-style: italic; color: #aaa; font-size: 0.9rem; }
        
        .button-group { margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
        .btn { text-decoration: none; color: white; padding: 12px 5px; border-radius: 8px; text-align: center; font-weight: 600; border: none; cursor: pointer; font-size: 0.8rem; transition: opacity 0.3s ease, transform 0.1s; }
        .btn:active { transform: scale(0.95); }
        .btn-booking { background-color: var(--primary-blue); }
        .btn-start { background-color: var(--accent-green); }
        .btn-finish { background-color: var(--dark-gray); }        
        
        @keyframes zoomIn { to { transform: scale(1); } }
        
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9rem; color: var(--primary-blue); }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 0.95rem; transition: border-color 0.3s, box-shadow 0.3s; background-color: var(--bg-white); color: var(--text-color); }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2); }
        
        .radio-group input[type="radio"] { opacity: 0; position: fixed; width: 0; }
        .radio-group { display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 10px; }
        .radio-group label { display: inline-block; padding: 10px; background-color: var(--bg-white); border: 2px solid var(--border-color); border-radius: 8px; text-align: center; cursor: pointer; font-weight: 600; font-size: 0.85rem; color: var(--text-color); transition: all 0.3s ease; -webkit-tap-highlight-color: transparent; }
        .radio-group label:hover { border-color: var(--accent-blue); }
        .radio-group input[type="radio"]:checked + label { background-color: #e8f4f8; color: var(--primary-blue); border-color: var(--primary-blue); }
        
        .photo-preview { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px; }
        .photo-preview img { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 1px solid var(--border-color); }
        
        .history-button-container { text-align: center; margin-top: 25px; margin-bottom: 20px; }
        .btn-history { background-color: var(--dark-gray); padding: 12px 25px; font-size: 1rem; color: white; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; width: 100%; transition: background-color 0.3s; }
        .btn-history:hover { background-color: #5d6d7e; }
        
        #history-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        #history-table th, #history-table td { border: 1px solid var(--border-color); padding: 10px; text-align: left; font-size: 0.9rem; }
        #history-table th { background-color: var(--primary-blue); color: white; }
        #history-table tr:nth-child(even) { background-color: var(--light-gray); }
    </style>
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

@push('js')
<script>
setInterval(() => {
    navigator.geolocation.getCurrentPosition(
        function(position) {

            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            @this.call('setLocation', lat, lng);

        },
        function(error) {
            @this.call('showDeniedLocation');
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