<?php

namespace App\Repositories\Exata;

use App\Models\Exata\Exata;
use App\Repositories\MasterDataRepository;

class ExataRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Exata::class;
    }

    public static function datatable()
    {
        return Exata::query();
    }
}
