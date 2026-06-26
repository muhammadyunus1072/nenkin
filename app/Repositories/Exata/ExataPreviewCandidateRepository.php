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

    public static function datatable(
        $sortBy = null,
        $sortDirection = 'asc',
    ) {

        return ExataPreviewCandidate::when($sortBy, function ($q) use ($sortBy, $sortDirection) {
            $q->orderBy($sortBy, $sortDirection);
        });
    }
}
