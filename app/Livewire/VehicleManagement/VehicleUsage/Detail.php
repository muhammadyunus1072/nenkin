<?php

namespace App\Livewire\VehicleManagement\VehicleUsage;

use App\Helpers\Alert;
use App\Repositories\VehicleManagement\VehicleBookingRepository;
use App\Repositories\VehicleManagement\VehicleMaintenanceByIntervalRepository;
use App\Repositories\VehicleManagement\VehicleMaintenanceByOdometerRepository;
use App\Repositories\VehicleManagement\VehicleRepository;
use App\Repositories\VehicleManagement\VehicleUsageRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $vehicles = [];
    public $vehicle_id;

    public $tire_condition_options = [
        'baik' => 'Baik',
        'cukup' => 'Cukup',
        'perlu_diperiksa' => 'Perlu Diperiksa'
    ];

    public $light_condition_options = [
        'semua_menyala' => 'Semua Menyala',
        'ada_yang_mati' => 'Ada Yang Mati',
    ];

    public $exterior_condition_options = [
        'bersih' => 'Bersih',
        'tidak_terlalu_kotor' => 'Tidak Terlalu Kotor',
        'kotor' => 'Kotor',
    ];

    public $interior_condition_options = [
        'bersih' => 'Bersih',
        'tidak_terlalu_kotor' => 'Tidak Terlalu Kotor',
        'kotor' => 'Kotor',
    ];

    // GPS
    public $ongoing_vehicle;
    public $lat;
    public $lng;

    // Booking
    public $purpose;
    public $destination;
    public $start_time;
    public $estimated_end_time;

    // Start
    public $start_tire_condition = 'baik';
    public $start_light_condition = 'semua_menyala';
    public $start_exterior_condition = 'bersih';
    public $start_interior_condition = 'bersih';

    public $start_odometer = 0;
    public $start_fuel = 0;
    public $start_etoll_balance = 0;

    // End
    public $end_tire_condition = 'baik';
    public $end_light_condition = 'semua_menyala';
    public $end_exterior_condition = 'bersih';
    public $end_interior_condition = 'bersih';

    public $end_odometer = 0;
    public $end_fuel = 0;
    public $end_etoll_balance = 0;

    // Maintenance

    public $maintenance_current_odometer = 0;
    public $vehicle_maintenance;
    public $vehicle_maintenance_intervals = [];
    public $vehicle_maintenance_odometers = [];
    public $vehicle_usage_ongoing_id;


    public function mount()
    {
        $this->vehicles = VehicleRepository::getBy([
            ['is_active', true],
        ]);

        $this->ongoing_vehicle = VehicleUsageRepository::findBy([
            ['user_id', auth()->user()->id],
            ['is_started', true],
            ['is_done', false]
        ]);
    }

    public function updatedImage() {}

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        $this->redirectRoute('vehicle-usage.index');
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('vehicle-usage.index');
    }

    public function openMaintenance($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $vehicle_maintenance = VehicleRepository::find($vehicle_id);
        $this->vehicle_maintenance = $vehicle_maintenance;
        $this->maintenance_current_odometer = $vehicle_maintenance->current_odometer;
        $this->vehicle_maintenance_intervals = [];
        $vehicle_maintenance_intervals = $vehicle_maintenance
            ->vehicleMaintenanceByIntervals;
        foreach ($vehicle_maintenance_intervals as $maintenance) {
            $this->vehicle_maintenance_intervals[] = [
                'id' => $maintenance->id,
                'name' => $maintenance->name,
                'current_interval' => $maintenance->current_interval,
                'notif_interval' => $maintenance->notif_interval,
                'is_checked' => false
            ];
        }
        $this->vehicle_maintenance_odometers = [];
        $vehicle_maintenance_odometers = $vehicle_maintenance
            ->vehicleMaintenanceByodometers;
        foreach ($vehicle_maintenance_odometers as $maintenance) {
            $this->vehicle_maintenance_odometers[] = [
                'id' => $maintenance->id,
                'name' => $maintenance->name,
                'latest_odometer' => $maintenance->latest_odometer,
                'notif_odometer' => $maintenance->notif_odometer,
                'is_checked' => false
            ];
        }
    }

    public function setLocation($lat, $lng)
    {
        if ($this->ongoing_vehicle) {
            // Vehicle
            $validateData = [
                'lat' => $lat,
                'lng' => $lng,
            ];
            $this->lat = $lat;
            $this->lng = $lng;
            VehicleRepository::update($this->ongoing_vehicle->vehicle_id, $validateData);
        }
    }
    public function showDeniedLocation() {}

    public function openBooking($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
    }
    public function openStart($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
    }
    public function openDone($vehicle_id, $vehicle_usage_ongoing_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->vehicle_usage_ongoing_id = $vehicle_usage_ongoing_id;
    }

    public function saveMaintenance()
    {
        try {
            $this->validate([
                'maintenance_current_odometer' => 'required|numeric',
            ]);
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'current_odometer' => $this->maintenance_current_odometer,
                ];
                $vehicle = VehicleRepository::update($this->vehicle_id, $validateData);
                foreach ($this->vehicle_maintenance_intervals as $maintenance) {
                    if ($maintenance['is_checked']) {
                        $validateData = [
                            'current_interval' => 0,
                        ];

                        $vehicle = VehicleMaintenanceByIntervalRepository::update($maintenance['id'], $validateData);
                    }
                }
                $this->vehicle_maintenance_intervals = [];
                foreach ($this->vehicle_maintenance_odometers as $maintenance) {
                    if ($maintenance['is_checked']) {
                        $validateData = [
                            'latest_odometer' => $this->maintenance_current_odometer,
                        ];

                        $vehicle = VehicleMaintenanceByOdometerRepository::update($maintenance['id'], $validateData);
                    }
                }
                $this->vehicle_maintenance_odometers = [];
            });

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }
    public function saveBooking()
    {
        try {
            $this->validate([
                'start_time' => 'required|date_format:Y-m-d\TH:i',
            ]);
            DB::transaction(function () {
                // Validate Booking Time Existed
                $bookings = VehicleBookingRepository::getBy([
                    ['start_time', '<=', $this->start_time],
                    ['estimated_end_time', '>=', $this->start_time]
                ])->toArray();
                if ($bookings) {
                    throw new Exception("Waktu Sudah TerBooking");
                }
                // Vehicle
                $validateData = [
                    'vehicle_id' => $this->vehicle_id,
                    'purpose' => $this->purpose,
                    'destination' => $this->destination,
                    'start_time' => $this->start_time,
                    'estimated_end_time' => $this->estimated_end_time,

                ];

                $vehicle = VehicleBookingRepository::create($validateData);
            });

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }
    public function saveStart()
    {
        try {
            $this->validate([
                'start_odometer' => 'required|numeric',
                'start_fuel' => 'required|numeric',
                'start_etoll_balance' => 'required|numeric',
            ]);
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'vehicle_id' => $this->vehicle_id,
                    'start_odometer' => $this->start_odometer,
                    'start_fuel' => $this->start_fuel,
                    'start_etoll_balance' => $this->start_etoll_balance,
                    'start_tire_condition' => $this->start_tire_condition,
                    'start_light_condition' => $this->start_light_condition,
                    'start_exterior_condition' => $this->start_exterior_condition,
                    'start_interior_condition' => $this->start_interior_condition,
                    'is_started' => true,

                ];
                $vehicle = VehicleUsageRepository::create($validateData);
            });

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }
    public function saveEnd()
    {
        try {
            $this->validate([
                'end_odometer' => 'required|numeric',
                'end_fuel' => 'required|numeric',
                'end_etoll_balance' => 'required|numeric',
            ]);
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'end_odometer' => $this->end_odometer,
                    'end_fuel' => $this->end_fuel,
                    'end_etoll_balance' => $this->end_etoll_balance,
                    'end_tire_condition' => $this->end_tire_condition,
                    'end_light_condition' => $this->end_light_condition,
                    'end_exterior_condition' => $this->end_exterior_condition,
                    'end_interior_condition' => $this->end_interior_condition,
                    'is_done' => true,

                ];
                $vehicle = VehicleUsageRepository::update($this->vehicle_usage_ongoing_id, $validateData);
            });

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.vehicle-management.vehicle-usage.detail');
    }
}
