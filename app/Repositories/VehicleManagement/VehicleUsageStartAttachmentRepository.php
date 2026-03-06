<?php

namespace App\Repositories\VehicleManagement;

use App\Models\VehicleManagement\VehicleUsageStartAttachment;
use App\Repositories\MasterDataRepository;

class VehicleUsageStartAttachmentRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return VehicleUsageStartAttachment::class;
    }

    public static function datatable()
    {
        return VehicleUsageStartAttachment::query();
    }
}
