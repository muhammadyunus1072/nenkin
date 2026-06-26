<?php

namespace App\Livewire\VehicleManagement\Vehicle;

use App\Helpers\Alert;
use App\Helpers\FilePathHelper;
use App\Repositories\VehicleManagement\VehicleRepository;
use App\Repositories\VehicleManagement\VehicleMaintenanceByIntervalRepository;
use App\Repositories\VehicleManagement\VehicleMaintenanceByOdometerRepository;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $objId;

    public $image;
    public $image_old;
    public $name;
    public $number_plate;
    public $max_range;
    public $current_odometer;
    public $current_fuel;
    public $current_etoll_balance;
    public $is_active;

    // Maintenance By Interval
    public $maintenance_by_intervals = [];
    public $maintenance_by_interval_removes = [];

    // Maintenance By Odometer
    public $maintenance_by_odometers = [];
    public $maintenance_by_odometer_removes = [];

    public function mount()
    {
        if ($this->objId) {
            $vehicle = VehicleRepository::find(Crypt::decrypt($this->objId));
            $this->image_old = Storage::url($vehicle->image);
            $this->name = $vehicle->name;
            $this->number_plate = $vehicle->number_plate;
            $this->max_range = $vehicle->max_range;
            $this->current_odometer = $vehicle->current_odometer;
            $this->current_fuel = $vehicle->current_fuel;
            $this->current_etoll_balance = $vehicle->current_etoll_balance;
            $this->is_active = $vehicle->is_active ? true : false;

            $vehicle_maintenance_by_intervals = VehicleMaintenanceByIntervalRepository::getBy([
                ['vehicle_id', $vehicle->id],
            ]);
            foreach ($vehicle_maintenance_by_intervals as $service) {
                $this->maintenance_by_intervals[] = [
                    'id' => Crypt::encrypt($service->id),
                    'name' => $service->name,
                    'message' => $service->message,
                    'notif_interval' => $service->notif_interval,
                    'current_interval' => $service->current_interval,
                    'is_show' => $service->is_show ? true : false,
                ];
            }

            $vehicle_maintenance_by_odometers = VehicleMaintenanceByOdometerRepository::getBy([
                ['vehicle_id', $vehicle->id],
            ]);
            foreach ($vehicle_maintenance_by_odometers as $service) {
                $this->maintenance_by_odometers[] = [
                    'id' => Crypt::encrypt($service->id),
                    'name' => $service->name,
                    'message' => $service->message,
                    'notif_odometer' => $service->notif_odometer,
                    'latest_odometer' => $service->latest_odometer,
                    'is_show' => $service->is_show ? true : false,
                ];
            }
        }
    }

    public function updatedImage()
    {
        $this->image_old = null;
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('vehicle.edit', $this->objId);
        } else {
            $this->redirectRoute('vehicle.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('vehicle.index');
    }

    public function addMaintenanceByInterval()
    {
        $this->maintenance_by_intervals[] = [
            'id' => null,
            'name' => '',
            'message' => '',
            'notif_interval' => 0,
            'current_interval' => 0,
            'is_show' => false,
        ];
    }

    public function removeMaintenanceByInterval($index)
    {
        if ($this->maintenance_by_intervals[$index]['id']) {
            $this->maintenance_by_interval_removes[] = $this->maintenance_by_intervals[$index]['id'];
        }
        unset($this->maintenance_by_intervals[$index]);
    }


    public function addMaintenanceByOdometer()
    {
        $this->maintenance_by_odometers[] = [
            'id' => null,
            'name' => '',
            'message' => '',
            'notif_odometer' => 0,
            'latest_odometer' => 0,
            'is_show' => false,
        ];
    }

    public function removeMaintenanceByOdometer($index)
    {
        if ($this->maintenance_by_odometers[$index]['id']) {
            $this->maintenance_by_odometer_removes[] = $this->maintenance_by_odometers[$index]['id'];
        }
        unset($this->maintenance_by_odometers[$index]);
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'is_active' => $this->is_active,
                    'name' => $this->name,
                    'number_plate' => $this->number_plate,
                    'max_range' => $this->max_range,
                    'current_odometer' => $this->current_odometer,
                    'current_fuel' => $this->current_fuel,
                    'current_etoll_balance' => $this->current_etoll_balance,
                ];
                $vehicle_id = null;
                if ($this->image) {
                    $path = $this->image->store(FilePathHelper::FILE_VEHICLE_IMAGE, 'public');
                    $validateData['image'] = $path;
                }

                if ($this->objId) {
                    $vehicle = VehicleRepository::find(Crypt::decrypt($this->objId));
                    if ($vehicle) {
                        VehicleRepository::update($vehicle->id, $validateData);
                        $vehicle_id = $vehicle->id;
                    }
                } else {
                    $vehicle = VehicleRepository::create($validateData);
                    $vehicle_id = $vehicle->id;
                }

                // Vehicle Service
                foreach ($this->maintenance_by_intervals as $service) {
                    $validateDataService = [
                        'vehicle_id' => $vehicle_id,
                        'name' => $service['name'],
                        'message' => $service['message'],
                        'notif_interval' => $service['notif_interval'],
                        'current_interval' => $service['current_interval'],
                        'is_show' => $service['is_show'],
                    ];

                    if ($service['id']) {
                        // Update
                        VehicleMaintenanceByIntervalRepository::update(Crypt::decrypt($service['id']), $validateDataService);
                    } else {

                        // Create
                        VehicleMaintenanceByIntervalRepository::create($validateDataService);
                    }
                }

                // Remove Vehicle Service
                foreach ($this->maintenance_by_interval_removes as $maintenance_by_interval_remove) {
                    VehicleMaintenanceByIntervalRepository::delete(Crypt::decrypt($maintenance_by_interval_remove));
                }

                // Vehicle Service
                foreach ($this->maintenance_by_odometers as $service) {
                    $validateDataService = [
                        'vehicle_id' => $vehicle_id,
                        'name' => $service['name'],
                        'message' => $service['message'],
                        'notif_odometer' => $service['notif_odometer'],
                        'latest_odometer' => $service['latest_odometer'],
                        'is_show' => $service['is_show'],
                    ];

                    if ($service['id']) {
                        // Update
                        VehicleMaintenanceByOdometerRepository::update(Crypt::decrypt($service['id']), $validateDataService);
                    } else {

                        // Create
                        VehicleMaintenanceByOdometerRepository::create($validateDataService);
                    }
                }

                // Remove Vehicle Service
                foreach ($this->maintenance_by_odometer_removes as $maintenance_by_odometer_remove) {
                    VehicleMaintenanceByOdometerRepository::delete(Crypt::decrypt($maintenance_by_odometer_remove));
                }
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
        return view('livewire.vehicle-management.vehicle.detail');
    }
}
