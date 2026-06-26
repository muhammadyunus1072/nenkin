<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\Vehicle;
use App\Repositories\MasterDataRepository;

class VehicleRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Vehicle::class;
    }

    public static function datatable()
    {
        return Vehicle::query();
    }

    public static function getActive()
    {
        return Vehicle::query();
    }
}
