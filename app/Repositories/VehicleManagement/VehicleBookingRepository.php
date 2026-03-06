<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\VehicleBooking;
use App\Repositories\MasterDataRepository;

class VehicleBookingRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return VehicleBooking::class;
    }

    public static function datatable()
    {
        return VehicleBooking::query();
    }
}
