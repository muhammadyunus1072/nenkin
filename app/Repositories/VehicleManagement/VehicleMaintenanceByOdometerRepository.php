<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\VehicleMaintenanceByOdometer;
use App\Repositories\MasterDataRepository;

class VehicleMaintenanceByOdometerRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return VehicleMaintenanceByOdometer::class;
    }

    public static function datatable()
    {
        return VehicleMaintenanceByOdometer::query();
    }
}
