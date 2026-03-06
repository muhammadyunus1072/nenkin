<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\VehicleMaintenanceByInterval;
use App\Repositories\MasterDataRepository;

class VehicleMaintenanceByIntervalRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return VehicleMaintenanceByInterval::class;
    }

    public static function datatable()
    {
        return VehicleMaintenanceByInterval::query();
    }
}
