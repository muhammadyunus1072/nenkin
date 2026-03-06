<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\VehicleUsageEndAttachment;
use App\Repositories\MasterDataRepository;

class VehicleUsageEndAttachmentRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return VehicleUsageEndAttachment::class;
    }

    public static function datatable()
    {
        return VehicleUsageEndAttachment::query();
    }
}
