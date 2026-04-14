<?php

namespace App\Repositories\Exata;

use App\Models\Exata\Exata;
use App\Models\Exata\ExataPreviewCandidate;
use App\Repositories\MasterDataRepository;
use Illuminate\Support\Facades\DB;

class ExataPreviewCandidateRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ExataPreviewCandidate::class;
    }

    public static function datatable()
    {
        return ExataPreviewCandidate::query();
    }
}
