<?php

namespace App\Repositories\Exata;

use App\Models\Exata\ExataFormCandidate;
use App\Repositories\MasterDataRepository;

class ExataFormCandidateRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ExataFormCandidate::class;
    }

    public static function datatable()
    {
        return ExataFormCandidate::query();
    }
}
