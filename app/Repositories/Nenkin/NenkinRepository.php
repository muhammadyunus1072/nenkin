<?php

namespace App\Repositories\Nenkin;

use App\Models\Nenkin;
use App\Repositories\MasterDataRepository;

class NenkinRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Nenkin::class;
    }

    public static function datatable()
    {
        return Nenkin::query();
    }
}
