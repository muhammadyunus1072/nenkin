<?php

namespace App\Repositories\MasterData\Regency;

use App\Models\MasterData\Regency;
use App\Repositories\MasterDataRepository;

class RegencyRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Regency::class;
    }

    public static function datatable()
    {
        return Regency::query();
    }
}
