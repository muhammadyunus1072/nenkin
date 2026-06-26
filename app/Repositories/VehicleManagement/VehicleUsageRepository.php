<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\VehicleUsage;
use App\Repositories\MasterDataRepository;

class VehicleUsageRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return VehicleUsage::class;
    }

    public static function datatable()
    {
        return VehicleUsage::query();
    }
}
