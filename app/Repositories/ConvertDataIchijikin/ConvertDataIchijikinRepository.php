<?php

namespace App\Repositories\ConvertDataIchijikin;

use App\Models\ConvertDataIchijikin;
use App\Repositories\MasterDataRepository;

class ConvertDataIchijikinRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ConvertDataIchijikin::class;
    }

    public static function datatable()
    {
        return ConvertDataIchijikin::query();
    }
}
